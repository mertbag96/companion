import type { Page } from '@inertiajs/core';
import { getRouteLocale, getUrlRouteDefaults } from '@/lib/routeLocale';

/**
 * Shared Inertia props used to build Wayfinder route args (locale + translated URL segments).
 */
export type WayfinderSharedPageProps = {
    locale: string;
    url_route_defaults: Record<string, string>;
};

/**
 * Route args from synced locale defaults (no `usePage()`). Use inside `defineOptions()` — it is hoisted
 * and cannot reference `usePage()` or other locals.
 */
export function wfArgsStatic(
    overrides?: Record<string, string | number>,
     
): any {
    return {
        ...getUrlRouteDefaults(),
        locale: getRouteLocale(),
        ...overrides,
    };
}

/**
 * Merge server-provided URL defaults (translated slugs) with optional overrides for Wayfinder helpers.
 *
 * Return type is intentionally loose: Wayfinder route factories expect concrete parameter shapes per
 * route, while Laravel + `setUrlDefaults` supply every segment via `url_route_defaults`.
 */
export function wfArgs(
    page: Page<WayfinderSharedPageProps>,
    overrides?: Record<string, string | number>,
     
): any {
    return {
        ...page.props.url_route_defaults,
        locale: page.props.locale,
        ...overrides,
    };
}
