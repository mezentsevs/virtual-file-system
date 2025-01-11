<script setup>
defineProps({
    item: {
        type: Array,
        default: [],
    },
});
</script>

<template>
    <div class="item-panel m-4 ml-0 p-4 w-2/3 min-w-[400px] min-h-[600px] text-gray-500 dark:text-gray-400 border-solid border-[1px] border-gray-500 dark:border-gray-400 rounded-lg">
        <h3>{{ item.name }}</h3>
    </div>
</template>
