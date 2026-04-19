import { getInitialPageFromDOM } from '@inertiajs/core';
import { setUrlDefaults } from '@/wayfinder';

const envLocale = (import.meta.env.VITE_APP_LOCALE as string | undefined) ?? 'en';

let routeLocale = envLocale;

/** Mirrors Wayfinder `setUrlDefaults` for use in `defineOptions()` (cannot use `usePage()` there). */
let urlRouteDefaults: Record<string, string> = {};

type InitialPageProps = {
    locale?: string;
    url_route_defaults?: Record<string, string>;
};

/**
 * Current locale for Wayfinder `{locale}` route parameters (synced with Inertia + URL defaults).
 */
export function getRouteLocale(): string {
    return routeLocale;
}

/**
 * Current translated URL segment defaults (synced with Inertia + Wayfinder).
 */
export function getUrlRouteDefaults(): Record<string, string> {
    return { ...urlRouteDefaults };
}

export function setRouteLocale(
    locale: string,
    urlDefaults?: Record<string, string>,
): void {
    routeLocale = locale;
    const merged = urlDefaults
        ? { ...urlDefaults, locale }
        : { ...urlRouteDefaults, locale };
    setUrlDefaults(merged);
    urlRouteDefaults = { ...merged };
}

/**
 * Call before `createInertiaApp` so the first paint has correct URLs (matches SSR / initial HTML).
 */
export function initRouteLocaleFromDocument(): void {
    const initial = getInitialPageFromDOM('app') as { props?: InitialPageProps } | null;
    const props = initial?.props;

    if (typeof props?.locale === 'string') {
        routeLocale = props.locale;
    }

    const defaults =
        props?.url_route_defaults ?? {
            locale: routeLocale,
        };

    setUrlDefaults(defaults);
    urlRouteDefaults = { ...defaults };
}
