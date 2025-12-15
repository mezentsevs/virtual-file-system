<template>
    <button
        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out cursor-pointer"
        type="button"
        aria-label="Toggle theme"
        @click="toggleTheme">
        <ThemeLightIcon v-if="currentTheme === 'dark'" class="w-5 h-5" />
        <ThemeDarkIcon v-else class="w-5 h-5" />
    </button>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import ThemeDarkIcon from '@/Components/Icons/ThemeDarkIcon.vue';
import ThemeLightIcon from '@/Components/Icons/ThemeLightIcon.vue';

const currentTheme = ref('light');

const updateThemeClass = theme => {
    const html = document.documentElement;

    if (theme === 'dark') {
        html.classList.add('dark');
    } else {
        html.classList.remove('dark');
    }
};

const toggleTheme = () => {
    currentTheme.value = currentTheme.value === 'dark' ? 'light' : 'dark';

    localStorage.setItem('theme', currentTheme.value);

    updateThemeClass(currentTheme.value);
};

onMounted(() => {
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme) {
        currentTheme.value = savedTheme;
    } else {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            currentTheme.value = 'dark';

            localStorage.setItem('theme', 'dark');
        }
    }

    updateThemeClass(currentTheme.value);
});

watch(currentTheme, newTheme => {
    updateThemeClass(newTheme);
});
</script>
