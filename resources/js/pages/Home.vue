<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { useTranslations } from '@/composables/useTranslations';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);

const { t } = useTranslations();
</script>

<template>
    <Head :title="t('website.meta.title')" />

    <div class="flex w-full items-center justify-center py-32">
        <h1 class="text-center text-2xl font-bold">
            {{ t('website.home.heading') }}
        </h1>
    </div>
</template>
