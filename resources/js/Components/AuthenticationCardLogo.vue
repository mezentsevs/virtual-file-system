<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link :href="'/'" class="inline-block w-[70px] h-[70px]">
        <ApplicationLogo class="p-[10px]" />
    </Link>
</template>
