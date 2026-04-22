<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { useTranslations } from '@/composables/useTranslations';

const { t } = useTranslations();
</script>

<template>
    <section class="w-full border-b border-border/60 py-16 md:py-24">
        <div class="max-w-[92%] xl:max-w-6xl 2xl:max-w-7xl mx-auto flex flex-col justify-center items-center text-center space-y-12 md:space-y-16">
            <div class="w-full flex flex-col justify-center items-center text-center space-y-6">
                <div class="space-y-4">
                    <h1 class="text-3xl font-semibold tracking-tight text-foreground sm:text-4xl lg:text-5xl lg:leading-tight">
                        {{ t('website.meta.title') }}
                    </h1>
                    <p class="text-base leading-relaxed text-muted-foreground sm:text-lg">
                        {{ t('website.meta.description') }}
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <Button
                        size="lg"
                        as-child
                        variant="outline"
                    >
                        <Link
                            href="/"
                            prefetch
                        >
                            {{ t('website.layout.header.nav.pricing') }}
                        </Link>
                    </Button>
                    <Button
                        size="lg"
                        as-child
                    >
                        <Link
                            href="/"
                            prefetch
                        >
                            {{ t('website.layout.header.actions.get_started') }}
                        </Link>
                    </Button>
                </div>
            </div>
            <div class="w-full rounded-xl border-4 border-black">
                <img
                    src="/assets/images/hero.png"
                    alt="Companion"
                    class="h-auto w-full rounded-xl border border-border/80 shadow-xs"
                    loading="lazy"
                    decoding="async"
                />
            </div>
        </div>
    </section>
</template>
