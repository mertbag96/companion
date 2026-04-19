<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { onWatcherCleanup, ref, watch } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import { Button } from '@/components/ui/button';

const isMenuOpen = ref(false);

const toggleMenu = (): void => {
    isMenuOpen.value = !isMenuOpen.value;
}

const closeMenu = (): void => {
    isMenuOpen.value = false;
}

watch(isMenuOpen, (open) => {
    document.body.style.overflow = open ? 'hidden' : '';
    onWatcherCleanup(() => {
        document.body.style.overflow = '';
    });
});
</script>

<template>
    <header
        class="sticky top-0 z-50 border-b border-border/60 bg-background/80 backdrop-blur-md supports-backdrop-filter:bg-background/75"
    >
        <div
            class="max-w-[92%] xl:max-w-6xl 2xl:max-w-7xl h-16 mx-auto flex items-center justify-between gap-4"
        >
            <Link
                href="/"
                class="text-foreground"
            >
                <AppLogo />
            </Link>

            <nav
                class="hidden shrink md:flex items-center gap-6 xl:gap-8"
                aria-label="Main"
            >
                <Link
                    href="/"
                    prefetch
                    class="whitespace-nowrap text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                >
                    Features
                </Link>
                <Link
                    href="/"
                    prefetch
                    class="whitespace-nowrap text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                >
                    Pricing
                </Link>
                <Link
                    href="/"
                    prefetch
                    class="whitespace-nowrap text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                >
                    About
                </Link>
                <Link
                    href="/"
                    prefetch
                    class="whitespace-nowrap text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                >
                    Blog
                </Link>
                <Link
                    href="/"
                    prefetch
                    class="whitespace-nowrap text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                >
                    Help center
                </Link>
            </nav>

            <div
                class="shrink-0 flex items-center gap-2 sm:gap-3"
            >
                <Button
                    variant="outline"
                    size="default"
                    as-child
                    class="hidden md:block"
                >
                    <Link
                        href="/"
                        prefetch
                    >
                        Log in
                    </Link>
                </Button>

                <Button
                    size="default"
                    as-child
                >
                    <Link
                        href="/"
                        prefetch
                    >
                        Get started
                    </Link>
                </Button>

                <div class="flex items-center md:hidden">
                    <Button
                        variant="outline"
                        size="default"
                        type="button"
                        class="w-10 h-10 shrink-0 p-0 cursor-pointer"
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

        <Teleport to="body">
            <div
                v-show="isMenuOpen"
                id="mobile-menu"
                class="fixed inset-0 z-40 flex min-h-dvh w-full flex-col bg-background/95 backdrop-blur-md supports-backdrop-filter:bg-background/90 md:hidden"
                role="dialog"
                aria-modal="true"
                aria-label="Mobile navigation"
            >
                <div class="h-16 shrink-0" aria-hidden="true" />
                <nav
                    class="w-[92%] mx-auto flex flex-1 flex-col justify-between pb-8 pt-4 font-medium text-muted-foreground"
                    aria-label="Main mobile"
                >
                    <div class="flex flex-col gap-1">
                        <Link
                            href="/"
                            prefetch
                            class="py-2.5 transition-colors hover:text-foreground"
                            @click="closeMenu"
                        >
                            Features
                        </Link>
                        <Link
                            href="/"
                            prefetch
                            class="py-2.5 transition-colors hover:text-foreground"
                            @click="closeMenu"
                        >
                            Pricing
                        </Link>
                        <Link
                            href="/"
                            prefetch
                            class="py-2.5 transition-colors hover:text-foreground"
                            @click="closeMenu"
                        >
                            About
                        </Link>
                        <Link
                            href="/"
                            prefetch
                            class="py-2.5 transition-colors hover:text-foreground"
                            @click="closeMenu"
                        >
                            Blog
                        </Link>
                        <Link
                            href="/"
                            prefetch
                            class="py-2.5 transition-colors hover:text-foreground"
                            @click="closeMenu"
                        >
                            Help center
                        </Link>
                    </div>

                    <div
                        class="flex flex-col gap-4"
                    >
                        <Button
                            variant="outline"
                            size="default"
                            class="w-full"
                            as-child
                        >
                            <Link
                                href="/"
                                prefetch
                                @click="closeMenu"
                            >
                                Log in
                            </Link>
                        </Button>
                        <Button
                            size="default"
                            class="w-full"
                            as-child
                        >
                            <Link
                                href="/"
                                prefetch
                                @click="closeMenu"
                            >
                                Get started
                            </Link>
                        </Button>
                    </div>
                </nav>
            </div>
        </Teleport>
    </header>
</template>
