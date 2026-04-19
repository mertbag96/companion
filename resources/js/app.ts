import { createInertiaApp, router } from '@inertiajs/vue3';
import { initializeTheme } from '@/composables/useAppearance';
import WebsiteLayout from '@/layouts/app/WebsiteLayout.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { initializeFlashToast } from '@/lib/flashToast';
import { initRouteLocaleFromDocument, setRouteLocale } from '@/lib/routeLocale';

const appName = import.meta.env.VITE_APP_NAME || 'Companion';

initRouteLocaleFromDocument();

router.on('navigate', (event) => {
    const { locale, url_route_defaults } = event.detail.page.props;

    if (typeof locale === 'string') {
        setRouteLocale(
            locale,
            url_route_defaults as Record<string, string> | undefined,
        );
    }
});

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    layout: (name) => {
        switch (true) {
            case name === 'Home':
                return WebsiteLayout;
            case name.startsWith('auth/'):
                return AuthLayout;
            case name.startsWith('settings/'):
                return [AppLayout, SettingsLayout];
            default:
                return AppLayout;
        }
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();

// This will listen for flash toast data from the server...
initializeFlashToast();
