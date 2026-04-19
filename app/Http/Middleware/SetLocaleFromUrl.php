<?php

namespace App\Http\Middleware;

use App\Support\LocalizedRoutePaths;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromUrl
{
    /**
     * Resolve locale from `{locale}` using mcamara/laravel-localization, sync URL defaults
     * (Wayfinder / route()), and Fortify redirect paths. Locale redirect middleware from the
     * package is not used here to avoid fighting the app's explicit `/` → localized home redirect.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeLocale = $request->route('locale');

        if (is_string($routeLocale)) {
            if (! LaravelLocalization::checkLocaleInSupportedLocales($routeLocale)) {
                abort(404);
            }
            LaravelLocalization::setLocale($routeLocale);
        } else {
            LaravelLocalization::setLocale();
        }

        $locale = app()->getLocale();

        URL::defaults(array_merge(
            ['locale' => $locale],
            LocalizedRoutePaths::urlDefaultsForLocale($locale),
        ));

        $this->syncFortifyRedirectPaths();

        return $next($request);
    }

    /**
     * Fortify reads string paths from config; point them at named routes so `{locale}` is included.
     */
    protected function syncFortifyRedirectPaths(): void
    {
        config([
            'fortify.home' => route('dashboard', [], false),
            'fortify.redirects.email-verification' => route('dashboard', [], false),
            'fortify.redirects.login' => route('dashboard', [], false),
            'fortify.redirects.register' => route('dashboard', [], false),
            'fortify.redirects.password-confirmation' => route('dashboard', [], false),
        ]);
    }
}
