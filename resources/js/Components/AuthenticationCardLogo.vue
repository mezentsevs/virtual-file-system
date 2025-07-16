<template>
    <Link :href="'/'" class="inline-block w-12 h-12">
        <ApplicationLogo />
    </Link>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>
