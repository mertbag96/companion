import { router, usePage } from '@inertiajs/vue3';

export function useLocaleSwitch() {
    const page = usePage<{
        locale: string;
        locales: Record<string, string>;
        locale_urls: Record<string, string>;
    }>();

    function switchLocale(targetLocale: string): void {
        if (targetLocale === page.props.locale) {
            return;
        }

        const url = page.props.locale_urls[targetLocale];

        if (typeof url === 'string' && url.length > 0) {
            const target = new URL(url, window.location.origin);
            router.visit(`${target.pathname}${window.location.search}`, {
                preserveScroll: true,
                preserveState: false,
            });
        }
    }

    return { switchLocale, currentLocale: () => page.props.locale };
}
