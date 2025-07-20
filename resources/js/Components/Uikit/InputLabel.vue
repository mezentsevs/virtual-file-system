<template>
    <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>

<script setup>
defineProps({
    value: String,
});
</script>
