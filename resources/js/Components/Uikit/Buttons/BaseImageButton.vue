<template>
    <div
        class="image-button fill-indigo-300 dark:fill-indigo-700 hover:fill-indigo-500 active:fill-indigo-700 dark:active:fill-indigo-300 cursor-pointer transition-[fill]">
        <slot />
    </div>
</template>

<style scoped>
.image-button:active {
    animation: expressive-bounce 0.5s ease-in-out;
}
</style>
