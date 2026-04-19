<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <span
        :class="
            cn(
                'text-lg leading-none font-bold tracking-[-0.04em] text-black antialiased dark:text-white',
                props.class,
            )
        "
    >
        companion.
    </span>
</template>
