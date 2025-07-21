<template>
    <Link
        :href="href"
        class="px-2 sm:px-3 py-1.5 sm:py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm sm:text-base text-black dark:text-white hover:text-black/70 dark:hover:text-white/80 focus:outline-none ring-1 ring-transparent focus-visible:ring-indigo-500 dark:focus-visible:ring-white rounded-md transition-all duration-200"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>
