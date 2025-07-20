<template>
    <Link :href="'/'" class="inline-block w-12 h-12 text-indigo-500 dark:text-indigo-600">
        <LogoIcon />
    </Link>
</template>

<script setup>
import LogoIcon from '@/Components/Icons/LogoIcon.vue';
import { Link } from '@inertiajs/vue3';
</script>
