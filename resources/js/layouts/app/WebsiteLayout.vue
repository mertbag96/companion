<script setup lang="ts">
import Footer from '@/components/website/Footer.vue';
import Header from '@/components/website/Header.vue';
</script>

<template>
    <div
        class="w-full overflow-x-hidden"
    >
        <Header />

        <main class="w-full">
            <slot />
        </main>

        <Footer />
    </div>
</template>
