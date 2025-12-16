<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    variant: {
        type: String,
        default: 'desktop',
        validator: value => ['desktop', 'mobile'].includes(value),
    },
});

const classes = computed(() => {
    const base =
        'bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white hover:text-white active:text-white rounded-lg transition-colors duration-200 active:scale-95';

    if (props.variant === 'mobile') {
        return `${base} flex items-center justify-center px-4 py-3 w-full text-sm`;
    }

    return `${base} px-4 py-1.5 text-sm`;
});
</script>
