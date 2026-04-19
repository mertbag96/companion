# Localization guide (agents & maintainers)

This application combines **Laravel**, **Inertia (Vue 3)**, **mcamara/laravel-localization**, **translated URL path segments**, and **Laravel Wayfinder** (typed route helpers). Follow this document whenever you **add, change, or remove routes**, **change user-visible copy**, or **touch locale-aware code** in PHP or TypeScript.

---

## 1. Goals

1. **URLs** include a locale prefix (`/en/...`, `/tr/...`, …) and **path segments** (slugs) that differ per language (e.g. `/en/login` vs `/tr/giris-yap`).
2. **One named route** in Laravel must match **all** localized slug variants via **regex alternation**, not duplicate route names per language.
3. **Server and client** generate the same URLs: Laravel `route()`, tests `URL::defaults`, Inertia shared props, Wayfinder `setUrlDefaults`, and helpers `wfArgs` / `wfArgsStatic` must stay aligned.
4. **User-visible strings** live in PHP `lang/{locale}/*.php` files; the Vue app consumes selected groups through Inertia props and `useTranslations()` where implemented.

---

## 2. Supported locales (source of truth)

| Concern | Location |
|--------|-----------|
| **Canonical list** | `config/laravellocalization.php` → `supportedLocales` |
| **Display labels** (language switcher) | `config/locales.php` — maps `supportedLocales[*].native` |
| **Order in URLs / switcher** | `config/laravellocalization.php` → `localesOrder` |

**Current locales (check repo for live list):** `en`, `tr`, `fr`, `de`, `es`.

**Rules for agents**

- Do **not** add a new locale only in Vue or only in `lang/` — update **`config/laravellocalization.php`** first, then add **`lang/{newLocale}/`** files (at minimum mirror `en` structure for any group you use).
- Keep `config('app.locale')` and `config('app.fallback_locale')` consistent with product expectations (usually `en`).

---

## 3. How URLs work (mental model)

1. Most web routes live under **`Route::prefix('{locale}')`** in `routes/web.php` (and included files).
2. **`SetLocaleFromUrl`** middleware reads `{locale}` from the current route, validates it against mcamara’s supported list, sets `app()->setLocale()`, then merges **`URL::defaults()`** with `LocalizedRoutePaths::urlDefaultsForLocale($locale)` so `route()` and Wayfinder get all wildcard defaults.
3. **Path segments** (e.g. `login`, `giris-yap`) are **not** hardcoded in route files as a single string; they are built from translations in **`lang/*/routes.php`** and regex `where()` clauses.
4. **mcamara** helpers such as `LaravelLocalization::transRoute('routes.some_key')` register which translation keys participate in **localized URL generation** for that route group.
5. **Fortify** routes are **not** loaded from the vendor package; they are defined in **`routes/fortify.php`** with the same slug pattern system (`Fortify::ignoreRoutes()` in `AppServiceProvider`).

---

## 4. Route slug translations (`lang/{locale}/routes.php`)

### 4.1 Purpose

Each **named route** that uses a **translatable segment** should have:

- A **translation key** in **every** locale file: `lang/en/routes.php`, `lang/tr/routes.php`, …
- The **same key** across locales; **values** are the **URL slug** for that language (ASCII, kebab-case recommended; Turkish etc. as required).

Example shape (keys are illustrative):

```php
// lang/en/routes.php
return [
    'login' => 'login',
    'dashboard' => 'dashboard',
    // ...
];

// lang/tr/routes.php
return [
    'login' => 'giris-yap',
    'dashboard' => 'kontrol-paneli',
    // ...
];
```

### 4.2 When you add a new slug

1. Add the key and slug string to **`lang/en/routes.php`** (reference).
2. Add the **same key** with the translated slug to **`lang/tr/routes.php`**, **`lang/fr/routes.php`**, **`lang/de/routes.php`**, **`lang/es/routes.php`** (and any new locale).
3. Wire the slug into **`App\Support\LocalizedRoutePaths`** (see §5).
4. Define or update the **route** in `routes/web.php`, `routes/settings.php`, or `routes/fortify.php` with `->where(..., LocalizedRoutePaths::pattern('routes.your_key'))` and call `LaravelLocalization::transRoute(...)` where required by mcamara for that group.
5. Run **`php artisan wayfinder:generate`** (see §10).
6. Run **`vendor/bin/pint --dirty`** on changed PHP and **`npm run types:check`** if TS/Vue changed.
7. Add or update a **feature test** that hits the new path for at least one non-default locale.

### 4.3 When you rename or remove a slug

- Update **all** `lang/*/routes.php` files for that key.
- Update **`LocalizedRoutePaths::urlParameterKeyMap()`** if the route parameter name or translation key changes.
- Search the codebase for the **old slug string** and **old key** (Fortify, tests, docs).
- Regenerate Wayfinder and run tests.

---

## 5. `App\Support\LocalizedRoutePaths` (required for new segments)

This class is the **bridge** between:

- **Route parameters** (`loginSlug`, `dashboardSlug`, …)
- **Translation keys** (`routes.login`, `routes.dashboard`, …)
- **Regex** for `where()` (`login|giris-yap|…`)
- **URL defaults** for `route()` / Wayfinder (`urlDefaultsForLocale()`)

### 5.1 Adding a new wildcard parameter

1. Choose a **parameter name** in the route URI, e.g. `{pricingSlug}`.
2. Add a **translation key** in `lang/*/routes.php`, e.g. `'pricing' => 'pricing'` (en) and localized slugs for other locales.
3. In **`LocalizedRoutePaths::urlParameterKeyMap()`**, add:

   `'pricingSlug' => 'routes.pricing',`

4. In the **route definition**, use:

   - `->where('pricingSlug', LocalizedRoutePaths::pattern('routes.pricing'))`
   - And for mcamara, if this route group expects it:  
     `LaravelLocalization::transRoute('routes.pricing');`  
     (follow existing patterns in `routes/web.php` / `routes/settings.php` / `routes/fortify.php`.)

5. Regenerate Wayfinder.

**Important:** `urlParameterKeyMap()` must list **every** `{something}` segment that participates in localized slugs so `URL::defaults` and Inertia `url_route_defaults` stay complete.

---

## 6. PHP route files (patterns to copy)

### 6.1 `routes/web.php`

- Root `/` redirects to localized home.
- **`Route::prefix('{locale}')`** wraps locale-scoped routes.
- Uses `LaravelLocalization::transRoute('routes.dashboard')` and `LocalizedRoutePaths::pattern('routes.dashboard')` for the dashboard segment.
- **`LoadTranslationsAction`**: example for **Home** passes `translations` for the `website` group (layout header/footer copy lives under `website.layout` in `lang/*/website.php`). When you add pages, either pass the same groups + new ones from the controller, or move shared groups to `HandleInertiaRequests` (product decision).

### 6.2 `routes/settings.php`

- Settings routes use **multiple** segments (`settingsSlug`, `profileSegment`, …), each with `LocalizedRoutePaths::pattern('routes.*')`.
- **PUT** password route uses `{passwordSegment}` with `routes.settings_password_segment`.

### 6.3 `routes/fortify.php`

- Custom Fortify routes; URIs use `{locale}` and translated slugs (`loginSlug`, etc.).
- Must stay consistent with **`lang/*/routes.php`** and **`LocalizedRoutePaths`**.

### 6.4 `bootstrap/app.php`

- Fortify routes are loaded in the `then:` callback from **`routes/fortify.php`** with Fortify middleware and prefix.

---

## 7. Middleware and server-side URL generation

| Middleware | Role |
|------------|------|
| **`SetLocaleFromUrl`** | Validates `{locale}`, sets Laravel + mcamara locale, **`URL::defaults`** + `LocalizedRoutePaths::urlDefaultsForLocale`, syncs Fortify redirect paths. |
| **`LaravelLocalizationRoutes`** | mcamara route helpers behavior (keep unless you know you’re replacing it). |
| **`HandleInertiaRequests`** | Shares `locale`, `locale_urls`, `url_route_defaults`, etc. |

**Fortify:** `SetLocaleFromUrl::syncFortifyRedirectPaths()` points Fortify config redirects at **named routes** so redirects include `{locale}`.

---

## 8. Inertia shared props (frontend contract)

Relevant shared props (see `HandleInertiaRequests`):

| Prop | Purpose |
|------|---------|
| `locale` | Current locale string. |
| `fallback_locale` | Fallback for UI logic. |
| `locales` | Map of locale → native label (from `config/locales.php`). |
| `locale_urls` | Map of locale → **switch URL** for the current page (mcamara). |
| `url_route_defaults` | **Merged** `locale` + every slug default from `LocalizedRoutePaths::urlDefaultsForLocale` — required for Wayfinder. |

**`initRouteLocaleFromDocument`** (`resources/js/lib/routeLocale.ts`) and **`router.on('navigate')`** in `resources/js/app.ts` sync **Wayfinder `setUrlDefaults`** with `locale` / `url_route_defaults` on load and client navigations.

---

## 9. Vue / TypeScript: Wayfinder and route arguments

### 9.1 Generated helpers

- Wayfinder outputs **`resources/js/routes/**`** (gitignored in some setups) and **`resources/js/wayfinder`**.
- After **any** PHP route change affecting URIs: run **`php artisan wayfinder:generate`**.

### 9.2 `wfArgs` and `wfArgsStatic`

- **`wfArgs(page)`** — use inside components with `usePage()`; merges `page.props.url_route_defaults` and `locale` for **`route()` / `*.url()` / forms**.
- **`wfArgsStatic()`** — use only where **`defineOptions()`** cannot reference `usePage()` (hoisting); uses **`getUrlRouteDefaults()`** + **`getRouteLocale()`** from `routeLocale.ts`.

Do **not** pass only `{ locale: page.props.locale }` to Wayfinder helpers for localized routes — **slug segments** must be included (via `wfArgs` / defaults).

### 9.3 `defineOptions()` in Vue SFCs

- Do **not** reference `usePage()` or `wfArgs(page)` inside **`defineOptions()`** — Vue hoists it. Use **`wfArgsStatic()`** for breadcrumb `href` values, or set breadcrumbs via a pattern that doesn’t close over setup locals.

### 9.4 Avoid `<Teleport to="body">` for large UI

- Inertia’s root HTML places **`<script data-page>`** before **`#app`**, which can break **Teleport** hydration to `body`. Prefer **in-layout** overlays (e.g. `fixed` inside `<header>`) or a **dedicated** mount point documented in the layout if you must teleport.

---

## 10. User-visible strings: PHP `lang` vs Vue

### 10.1 Laravel / PHP

- Use `__('file.key')`, `trans('file.key')`, or `Lang::get` for **backend** messages, emails, notifications, validation, etc.
- **Validation**: `lang/{locale}/validation.php` (and attribute names if you use custom attributes).
- **Auth / passwords / pagination**: existing files under `lang/{locale}/`.

### 10.2 Inertia + Vue (website copy)

- Translation **groups** are PHP files: e.g. `lang/en/website.php` → nested array.
- **`LoadTranslationsAction`** loads groups by name and returns them to Inertia as **`translations.{group}.*`**.
- **`useTranslations()`** (`resources/js/composables/useTranslations.ts`) reads **`page.props.translations`** and supports **dot keys** from the root of that tree, e.g. `t('website.home.heading')`, `t('website.layout.header.nav.features')`, `t('website.layout.footer.tagline')`. Fortify auth pages receive the same `website` group (including **`website.auth.{login|register|...}`**) via **`FortifyServiceProvider`**.
- **Replacements** in strings: `:name` and `{name}` in the PHP string, pass `replacements` as second argument to `t()`.

**When adding a new page with copy:**

1. Add strings under **`lang/en/{group}.php`** (and parallel files for **tr, fr, de, es**).
2. Pass that group (and any others needed) via **`LoadTranslationsAction`** in the controller/`Inertia::render` for that page — **or** extend shared data in `HandleInertiaRequests` if the copy is global.
3. Use **`t('group.key')`** in Vue, not hard-coded English (unless explicitly out of scope).

### 10.3 TypeScript / non-Vue

- Prefer **no** user-facing strings in `.ts` files; if unavoidable, keep keys and load from the same `translations` prop or a dedicated API — do not fork English copy only in TS.

---

## 11. mcamara configuration notes

File: **`config/laravellocalization.php`**

- **`hideDefaultLocaleInURL`**: currently `false` — default locale appears in the URL; don’t assume “hidden en”.
- **`httpMethodsIgnored`**: includes mutating methods — understand before changing (affects localization middleware behavior).
- **`useAcceptLanguageHeader`**: app-specific; changing it affects redirects and tests.

For **route caching** with translated routes, prefer mcamara’s documented **`route:trans:cache`** workflow if you enable route caching in production; plain `route:cache` may not match translated route registration.

---

## 12. Testing (Pest)

- **`tests/Pest.php`** — `beforeEach` sets `LaravelLocalization::setLocale('en')` and **`URL::defaults`** using **`LocalizedRoutePaths::urlDefaultsForLocale('en')`**. Feature tests that rely on `route()` must use consistent defaults; for another locale, merge that locale’s defaults in the test (see `tests/Feature/LocaleTest.php`).
- Add assertions for **non-default locale** paths when you add slug keys.
- After route changes, run at least **`php artisan test --compact`** for affected tests.

---

## 13. Command checklist (run after changes)

| Change | Commands |
|--------|----------|
| PHP routes / Fortify / `LocalizedRoutePaths` | `php artisan wayfinder:generate`, `vendor/bin/pint --dirty`, `php artisan test --compact` |
| Vue / TS using routes | `npm run types:check` |
| Optional full FE build | `npm run build` or `npm run build:ssr` |

---

## 14. Quick “add a new localized page” checklist

1. [ ] Add **`lang/*/routes.php`** keys + slugs for every supported locale (if the page has its own segment).
2. [ ] Update **`LocalizedRoutePaths`** `urlParameterKeyMap` if new `{param}`.
3. [ ] Register route in **`routes/web.php`** (or included file) with `->where` + `LocalizedRoutePaths::pattern`, `->name`, middleware.
4. [ ] Call **`LaravelLocalization::transRoute`** where consistent with sibling routes.
5. [ ] Add **page copy** to **`lang/*/{group}.php`** for all locales; wire **`LoadTranslationsAction`** or shared props.
6. [ ] Create/update **Inertia Vue page**; use **`wfArgs(page)`** for Wayfinder links/forms.
7. [ ] **`php artisan wayfinder:generate`**, **`pint`**, **`npm run types:check`**, **`php artisan test`**.
8. [ ] Manually hit **`/en/...`** and **`/tr/...`** (or another non-en locale) in the browser.

---

## 15. Files to touch most often (reference)

| Area | Files |
|------|--------|
| Locales config | `config/laravellocalization.php`, `config/locales.php` |
| Slugs | `lang/*/routes.php`, `app/Support/LocalizedRoutePaths.php` |
| Routes | `routes/web.php`, `routes/settings.php`, `routes/fortify.php` |
| Middleware | `app/Http/Middleware/SetLocaleFromUrl.php`, `HandleInertiaRequests.php` |
| Fortify | `app/Providers/AppServiceProvider.php` (`Fortify::ignoreRoutes()`), `routes/fortify.php` |
| Inertia copy loading | `app/Actions/LoadTranslationsAction.php`, controllers / `Inertia::render` |
| Vue | `resources/js/composables/useTranslations.ts`, `resources/js/lib/routeLocale.ts`, `resources/js/lib/wayfinderArgs.ts`, `resources/js/app.ts` |
| Tests | `tests/Pest.php`, `tests/Feature/LocaleTest.php` |

---

## 16. Anti-patterns (avoid)

- Hardcoding localized path strings in Vue/PHP (`'/login'`, `'/tr/giris-yap'`) instead of **`route()` / Wayfinder** with **`wfArgs`**.
- Adding a slug in **one** language file only.
- Forgetting **`LocalizedRoutePaths`** when adding `{param}`.
- Skipping **`wayfinder:generate`** after route edits (TypeScript will drift).
- Using **`defineOptions()`** with **`wfArgs(page)`** — use **`wfArgsStatic()`** for static options.
- **`Teleport to="body"`** without checking Inertia root HTML / hydration (see §9.4).

---

*Last reviewed: align this document with `config/laravellocalization.php` and `lang/` when locales or route architecture change.*
