<script setup>
import { inject } from 'vue';

const folder = inject('currentItem');
</script>

<template>
    <h3>{{ folder.name }}</h3>
</template>
