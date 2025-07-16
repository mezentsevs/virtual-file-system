<template>
    <div v-show="message">
        <p class="text-red-600 dark:text-red-400 text-sm">
            {{ message }}
        </p>
    </div>
</template>

<script setup>
defineProps({
    message: String,
});
</script>
