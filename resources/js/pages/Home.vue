<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Hero from '@/components/website/Hero.vue';
import { useTranslations } from '@/composables/useTranslations';

const { t } = useTranslations();
</script>

<template>
    <Head :title="t('website.meta.title')" />

    <Hero />
</template>
