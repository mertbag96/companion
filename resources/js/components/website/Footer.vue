<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Check, Globe } from 'lucide-vue-next';
import { ref } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';

const currentLanguage = ref('English');

const changeLanguage = (locale: string) => {
    currentLanguage.value = locale;
};
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
                            href="/"
                            class="text-foreground"
                        >
                            <AppLogo />
                        </Link>
                        <p class="text-sm leading-relaxed text-foreground/75">
                            A modern companion for businesses that value simplicity, structure, and efficiency.
                        </p>
                    </div>

                    <div class="grid flex-1 grid-cols-2 gap-x-8 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 lg:gap-x-10">
                        <div class="space-y-4">
                            <p class="text-xs font-semibold tracking-wide text-foreground uppercase">
                                Product
                            </p>
                            <ul class="space-y-3 text-sm text-foreground/70">
                                <li>
                                    <Link
                                        href="/"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        Features
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        href="/"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        Pricing
                                    </Link>
                                </li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <p class="text-xs font-semibold tracking-wide text-foreground uppercase">
                                Resources
                            </p>
                            <ul class="space-y-3 text-sm text-foreground/70">
                                <li>
                                    <Link
                                        href="/"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        Blog
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        href="/"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        Help center
                                    </Link>
                                </li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <p class="text-xs font-semibold tracking-wide text-foreground uppercase">
                                Company
                            </p>
                            <ul class="space-y-3 text-sm text-foreground/70">
                                <li>
                                    <Link
                                        href="/"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        About
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        href="/"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        Contact
                                    </Link>
                                </li>
                            </ul>
                        </div>

                        <div class="space-y-4">
                            <p class="text-xs font-semibold tracking-wide text-foreground uppercase">
                                Legal
                            </p>
                            <ul class="space-y-3 text-sm text-foreground/70">
                                <li>
                                    <Link
                                        href="/"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        Privacy policy
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        href="/"
                                        class="transition-colors hover:text-foreground"
                                    >
                                        Terms of service
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
                        © 2026 Companion. All rights reserved.
                    </p>

                    <DropdownMenu class="">
                        <DropdownMenuTrigger :as-child="true">
                            <Button
                                variant="outline"
                                size="icon"
                                class="relative w-32 py-2 px-4 cursor-pointer"
                            >
                                <Globe class="size-4" />
                                <span class="text-xs">{{ currentLanguage }}</span>
                            </Button>
                        </DropdownMenuTrigger>

                        <DropdownMenuContent
                            align="start"
                            side="top"
                            class="w-auto"
                        >
                            <DropdownMenuItem
                                class="flex items-center justify-between cursor-pointer"
                                @click="changeLanguage('English')"
                            >
                                <span class="text-xs">English</span>
                                <Check
                                    class="size-4"
                                    v-if="currentLanguage === 'English'"
                                />
                            </DropdownMenuItem>

                            <DropdownMenuItem
                                class="flex items-center justify-between cursor-pointer"
                                @click="changeLanguage('Türkçe')"
                            >
                                <span class="text-xs">Türkçe</span>
                                <Check
                                    class="size-4"
                                    v-if="currentLanguage === 'Türkçe'"
                                />
                            </DropdownMenuItem>

                            <DropdownMenuItem
                                class="flex items-center justify-between cursor-pointer"
                                @click="changeLanguage('Français')"
                            >
                                <span class="text-xs">Français</span>
                                <Check
                                    class="size-4"
                                    v-if="currentLanguage === 'Français'"
                                />
                            </DropdownMenuItem>

                            <DropdownMenuItem
                                class="flex items-center justify-between cursor-pointer"
                                @click="changeLanguage('Deutsch')"
                            >
                                <span class="text-xs">Deutsch</span>
                                <Check
                                    class="size-4"
                                    v-if="currentLanguage === 'Deutsch'"
                                />
                            </DropdownMenuItem>

                            <DropdownMenuItem
                                class="flex items-center justify-between cursor-pointer"
                                @click="changeLanguage('Español')"
                            >
                                <span class="text-xs">Español</span>
                                <Check
                                    class="size-4"
                                    v-if="currentLanguage === 'Español'"
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
                        companion.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</template>
