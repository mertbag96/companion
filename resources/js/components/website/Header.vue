<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { Monitor, Moon, Sun } from 'lucide-vue-next';
import { onWatcherCleanup, ref, watch } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import { Button } from '@/components/ui/button';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { useAppearance } from '@/composables/useAppearance';
import { useTranslations } from '@/composables/useTranslations';
import { wfArgs } from '@/lib/wayfinderArgs';
import { home, login, register } from '@/routes';

const page = usePage<{ locale: string; url_route_defaults: Record<string, string> }>();

const { t } = useTranslations();
const { appearance, updateAppearance } = useAppearance();

const isMenuOpen = ref(false);

const setTheme = (value: unknown): void => {
    if (value === 'light' || value === 'dark' || value === 'system') {
        updateAppearance(value);
    }
};

const toggleMenu = (): void => {
    isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = (): void => {
    isMenuOpen.value = false;
};

watch(isMenuOpen, (open) => {
    document.body.style.overflow = open ? 'hidden' : '';
    onWatcherCleanup(() => {
        document.body.style.overflow = '';
    });
});
</script>

<template>
    <header class="sticky top-0 z-50">
        <div
            class="relative z-50 border-b border-border/60 bg-background/80 backdrop-blur-md supports-backdrop-filter:bg-background/75"
        >
            <div
                class="max-w-[92%] xl:max-w-6xl 2xl:max-w-7xl mx-auto flex h-16 items-center justify-between gap-4"
            >
                <Link
                    :href="home.url(wfArgs(page))"
                    class="text-foreground"
                >
                    <AppLogo />
                </Link>

                <nav
                    class="hidden shrink md:flex items-center gap-6 xl:gap-8"
                    aria-label="Main"
                >
                    <Link
                        :href="home.url(wfArgs(page))"
                        prefetch
                        class="whitespace-nowrap text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                    >
                        {{ t('website.layout.header.nav.features') }}
                    </Link>
                    <Link
                        :href="home.url(wfArgs(page))"
                        prefetch
                        class="whitespace-nowrap text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                    >
                        {{ t('website.layout.header.nav.pricing') }}
                    </Link>
                    <Link
                        :href="home.url(wfArgs(page))"
                        prefetch
                        class="whitespace-nowrap text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                    >
                        {{ t('website.layout.header.nav.about') }}
                    </Link>
                    <Link
                        :href="home.url(wfArgs(page))"
                        prefetch
                        class="whitespace-nowrap text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                    >
                        {{ t('website.layout.header.nav.blog') }}
                    </Link>
                </nav>

                <div
                    class="shrink-0 flex items-center gap-2 sm:gap-3"
                >
                <Select
                    :model-value="appearance"
                    @update:model-value="setTheme"
                >
                    <SelectTrigger
                        size="sm"
                        class="h-9 w-auto min-w-9 shrink-0 gap-1 border-0 bg-transparent px-2 shadow-none hover:bg-accent hover:text-accent-foreground ring-0 focus-visible:ring-0 cursor-pointer text-foreground"
                        :aria-label="t('website.layout.header.theme.select_aria')"
                    >
                        <SelectValue>
                            <span class="flex items-center text-foreground">
                                <Monitor
                                    v-if="appearance === 'system'"
                                    class="size-4 shrink-0"
                                    aria-hidden="true"
                                />
                                <Sun
                                    v-else-if="appearance === 'light'"
                                    class="size-4 shrink-0"
                                    aria-hidden="true"
                                />
                                <Moon
                                    v-else
                                    class="size-4 shrink-0"
                                    aria-hidden="true"
                                />
                            </span>
                        </SelectValue>
                    </SelectTrigger>
                    <SelectContent align="end">
                        <SelectItem
                            value="light"
                            class="cursor-pointer"
                        >
                            <Sun
                                class="size-4 text-muted-foreground"
                                aria-hidden="true"
                            />
                            {{ t('website.layout.header.theme.light') }}
                        </SelectItem>
                        <SelectItem
                            value="dark"
                            class="cursor-pointer"
                        >
                            <Moon
                                class="size-4 text-muted-foreground"
                                aria-hidden="true"
                            />
                            {{ t('website.layout.header.theme.dark') }}
                        </SelectItem>
                        <SelectItem
                            value="system"
                            class="cursor-pointer"
                        >
                            <Monitor
                                class="size-4 text-muted-foreground"
                                aria-hidden="true"
                            />
                            {{ t('website.layout.header.theme.system') }}
                        </SelectItem>
                    </SelectContent>
                </Select>

                <Button
                    variant="outline"
                    size="default"
                    as-child
                    class="hidden md:block"
                >
                    <Link
                        :href="login.url(wfArgs(page))"
                        prefetch
                    >
                        {{ t('website.layout.header.actions.login') }}
                    </Link>
                </Button>

                <Button
                    size="default"
                    as-child
                >
                    <Link
                        :href="register.url(wfArgs(page))"
                        prefetch
                    >
                        {{ t('website.layout.header.actions.get_started') }}
                    </Link>
                </Button>

                <div class="flex items-center md:hidden">
                    <Button
                        variant="outline"
                        size="default"
                        type="button"
                        class="h-10 w-10 shrink-0 cursor-pointer p-0"
                        :aria-expanded="isMenuOpen"
                        aria-controls="mobile-menu"
                        aria-label="Menu"
                        @click="toggleMenu"
                    >
                        <span class="relative flex h-5 w-5 items-center justify-center">
                            <span
                                class="absolute h-0.5 w-4 rounded-full bg-current transition-all duration-200 ease-out"
                                :class="
                                    isMenuOpen
                                        ? 'translate-y-0 rotate-45'
                                        : '-translate-y-2 rotate-0'
                                "
                            />
                            <span
                                class="absolute h-0.5 w-4 rounded-full bg-current transition-all duration-200 ease-out"
                                :class="isMenuOpen ? 'scale-x-0 opacity-0' : 'scale-x-100 opacity-100'"
                            />
                            <span
                                class="absolute h-0.5 w-4 rounded-full bg-current transition-all duration-200 ease-out"
                                :class="
                                    isMenuOpen
                                        ? 'translate-y-0 -rotate-45'
                                        : 'translate-y-2 rotate-0'
                                "
                            />
                        </span>
                    </Button>
                </div>
                </div>
            </div>
        </div>

        <div
            v-show="isMenuOpen"
            id="mobile-menu"
            class="fixed inset-0 z-40 flex min-h-dvh w-full flex-col bg-background md:hidden"
            role="dialog"
            aria-modal="true"
            aria-label="Mobile navigation"
        >
            <div class="h-16 shrink-0" aria-hidden="true" />
            <nav
                class="mx-auto flex w-[92%] flex-1 flex-col justify-between pb-8 pt-4 font-medium text-muted-foreground"
                aria-label="Main mobile"
            >
                <div class="flex flex-col gap-1">
                    <Link
                        :href="home.url(wfArgs(page))"
                        prefetch
                        class="py-2.5 transition-colors hover:text-foreground"
                        @click="closeMenu"
                    >
                        {{ t('website.layout.header.nav.features') }}
                    </Link>
                    <Link
                        :href="home.url(wfArgs(page))"
                        prefetch
                        class="py-2.5 transition-colors hover:text-foreground"
                        @click="closeMenu"
                    >
                        {{ t('website.layout.header.nav.pricing') }}
                    </Link>
                    <Link
                        :href="home.url(wfArgs(page))"
                        prefetch
                        class="py-2.5 transition-colors hover:text-foreground"
                        @click="closeMenu"
                    >
                        {{ t('website.layout.header.nav.about') }}
                    </Link>
                    <Link
                        :href="home.url(wfArgs(page))"
                        prefetch
                        class="py-2.5 transition-colors hover:text-foreground"
                        @click="closeMenu"
                    >
                        {{ t('website.layout.header.nav.blog') }}
                    </Link>
                    <Link
                        :href="home.url(wfArgs(page))"
                        prefetch
                        class="py-2.5 transition-colors hover:text-foreground"
                        @click="closeMenu"
                    >
                        {{ t('website.layout.header.nav.help') }}
                    </Link>
                </div>

                <div class="flex flex-col gap-4">
                    <Button
                        variant="outline"
                        size="default"
                        class="w-full"
                        as-child
                    >
                        <Link
                            :href="login.url(wfArgs(page))"
                            prefetch
                            @click="closeMenu"
                        >
                            {{ t('website.layout.header.actions.login') }}
                        </Link>
                    </Button>
                    <Button
                        size="default"
                        class="w-full"
                        as-child
                    >
                        <Link
                            :href="register.url(wfArgs(page))"
                            prefetch
                            @click="closeMenu"
                        >
                            {{ t('website.layout.header.actions.get_started') }}
                        </Link>
                    </Button>
                </div>
            </nav>
        </div>
    </header>
</template>
