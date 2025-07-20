<template>
    <component :is="heading" class="grow text-gray-800 dark:text-gray-200 text-center truncate">
        <slot />
    </component>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    level: {
        type: Number,
        default: 1,
    },
});

const heading = computed(() => {
    if (props.level < 1) {
        return 'h1';
    } else if (props.level > 6) {
        return 'h6';
    } else {
        return `h${props.level}`;
    }
});
</script>
