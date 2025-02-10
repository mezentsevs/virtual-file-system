<template>
    <div class="image-button fill-indigo-300 dark:fill-indigo-700 hover:fill-indigo-500 active:fill-indigo-700 dark:active:fill-indigo-300 cursor-pointer transition-[fill]">
        <slot />
    </div>
</template>

<style scoped>
.image-button:active {
    animation: bounce 0.5s;
}

@keyframes bounce {
    0% {
        transform: scale(0);
    }

    25% {
        transform: scale(1.1);
    }

    50% {
        transform: scale(1.25);
    }

    100% {
        transform: scale(1);
    }
}
</style>
