<script setup>
import { inject } from 'vue';

const file = inject('currentItem');
</script>

<template>
    <h3>{{ file.name }}</h3>
</template>
