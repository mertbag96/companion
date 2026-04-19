<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Your business companion for everyday operations." />
    <div class="py-32 w-full flex items-center justify-center">
        <h1 class="text-2xl font-bold text-center">Homepage</h1>
    </div>
</template>
