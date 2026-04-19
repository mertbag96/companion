<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { Check, Globe } from 'lucide-vue-next';
import { computed } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { useLocaleSwitch } from '@/composables/useLocaleSwitch';
import { useTranslations } from '@/composables/useTranslations';
import { wfArgs } from '@/lib/wayfinderArgs';
import { home } from '@/routes';

const page = usePage<{
    locale: string;
    locales: Record<string, string>;
    url_route_defaults: Record<string, string>;
}>();

const { t } = useTranslations();
const { switchLocale } = useLocaleSwitch();

const year = new Date().getFullYear();

const currentLanguageLabel = computed(
    () => page.props.locales[page.props.locale] ?? page.props.locale,
);
</script>

<template>
    <footer
        class="bg-background border-t border-border/60 text-foreground"
    >
        <div class="relative z-10">
            <div class="max-w-[92%] xl:max-w-6xl 2xl:max-w-7xl mx-auto py-14">
                <div class="flex flex-col gap-12 lg:flex-row lg:justify-between lg:gap-16">
                    <div class="max-w-2xs flex flex-col space-y-4">
                        <Link
                            :href="home.url(wfArgs(page))"
                            class="text-foreground"
                        >
                            <AppLogo />
                        </Link>
                        <p class="text-sm leading-relaxed text-foreground/75">
                            {{ t('footer.tagline') }}
                        </p>
                    </div>

                    <div class="grid flex-1 grid-cols-2 gap-x-8 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 lg:gap-x-10">
                        <div class="space-y-4">
                            <p class="text-xs font-semibold tracking-wide text-foreground uppercase">
                                {{ t('footer.columns.product.label') }}
                            </p>
                            <ul class="space-y-3 text-sm text-foreground/70">
                                <li>
                                    <Link
                                        :href="home.url(wfArgs(page))"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        {{ t('footer.columns.product.links.features') }}
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        :href="home.url(wfArgs(page))"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        {{ t('footer.columns.product.links.pricing') }}
                                    </Link>
                                </li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <p class="text-xs font-semibold tracking-wide text-foreground uppercase">
                                {{ t('footer.columns.resources.label') }}
                            </p>
                            <ul class="space-y-3 text-sm text-foreground/70">
                                <li>
                                    <Link
                                        :href="home.url(wfArgs(page))"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        {{ t('footer.columns.resources.links.blog') }}
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        :href="home.url(wfArgs(page))"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        {{ t('footer.columns.resources.links.help') }}
                                    </Link>
                                </li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <p class="text-xs font-semibold tracking-wide text-foreground uppercase">
                                {{ t('footer.columns.company.label') }}
                            </p>
                            <ul class="space-y-3 text-sm text-foreground/70">
                                <li>
                                    <Link
                                        :href="home.url(wfArgs(page))"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        {{ t('footer.columns.company.links.about') }}
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        :href="home.url(wfArgs(page))"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        {{ t('footer.columns.company.links.contact') }}
                                    </Link>
                                </li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <p class="text-xs font-semibold tracking-wide text-foreground uppercase">
                                {{ t('footer.columns.legal.label') }}
                            </p>
                            <ul class="space-y-3 text-sm text-foreground/70">
                                <li>
                                    <Link
                                        :href="home.url(wfArgs(page))"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        {{ t('footer.columns.legal.links.privacy') }}
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        :href="home.url(wfArgs(page))"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        {{ t('footer.columns.legal.links.terms') }}
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-border/60 py-6">
                <div class="max-w-[92%] xl:max-w-6xl 2xl:max-w-7xl mx-auto gap-6 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs text-foreground/60">
                        {{ t('footer.copyright', { year }) }}
                    </p>

                    <DropdownMenu class="">
                        <DropdownMenuTrigger :as-child="true">
                            <Button
                                variant="outline"
                                size="icon"
                                class="relative w-32 py-2 px-4 cursor-pointer"
                            >
                                <Globe class="size-4" />
                                <span class="text-xs">{{ currentLanguageLabel }}</span>
                            </Button>
                        </DropdownMenuTrigger>

                        <DropdownMenuContent
                            align="start"
                            side="top"
                            class="w-auto"
                        >
                            <DropdownMenuItem
                                v-for="(label, code) in page.props.locales"
                                :key="code"
                                class="flex cursor-pointer items-center justify-between"
                                @click="switchLocale(code)"
                            >
                                <span class="text-xs">{{ label }}</span>
                                <Check
                                    v-if="code === page.props.locale"
                                    class="size-4"
                                />
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </div>
            </div>

            <div class="w-full py-6 md:py-8 border-t border-border/60">
                <div class="overflow-x-clip">
                    <p
                        class="w-full text-center font-black tracking-[-0.078em] text-foreground lowercase"
                        style="font-size: clamp(3.25rem, 17vw, 13.5rem); line-height: 0.88;"
                    >
                        {{ t('footer.brand') }}
                    </p>
                </div>
            </div>
        </div>
    </footer>
</template>
