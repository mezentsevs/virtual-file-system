<script setup>
defineProps({
    content: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <li class="flex flex-row items-center">
        <div class="inline-block w-[25px] h-[25px] shrink-0 cursor-pointer fill-gray-500 dark:fill-gray-400 hover:fill-indigo-600">
            <slot />
        </div>
        <span class="inline-block ml-[5px] cursor-default select-none">{{ content }}</span>
    </li>
</template>
