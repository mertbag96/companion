import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

type TranslationTree = Record<string, unknown>;

function getByDotPath(tree: TranslationTree, path: string): unknown {
    return path.split('.').reduce<unknown>((acc, segment) => {
        if (acc !== null && typeof acc === 'object' && segment in (acc as TranslationTree)) {
            return (acc as TranslationTree)[segment];
        }

        return undefined;
    }, tree);
}

export function useTranslations() {
    const page = usePage<{
        translations?: TranslationTree;
    }>();

    const translations = computed(() => (page.props.translations ?? {}) as TranslationTree);

    function t(key: string, replacements?: Record<string, string | number>): string {
        const value = getByDotPath(translations.value, key);

        if (typeof value !== 'string') {
            return key;
        }

        if (!replacements) {
            return value;
        }

        return Object.entries(replacements).reduce((str, [name, replaceValue]) => {
            return str.replaceAll(`:${name}`, String(replaceValue)).replaceAll(`{${name}}`, String(replaceValue));
        }, value);
    }

    return { t, translations };
}
