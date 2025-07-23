<template>
    <AppLayout title="Dashboard" class="min-w-[1024px]">
        <template #header>
            <h2 class="text-gray-800 dark:text-gray-200 text-xl font-semibold leading-tight">
                {{ appName }}
            </h2>
        </template>

        <section v-if="isLoaded" class="flex justify-center">
            <FileBrowser :folders="foldersStore.folders" class="w-full max-w-5xl m-12 bg-white dark:bg-gray-800 overflow-hidden rounded-none sm:rounded-2xl shadow-md" />
        </section>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FileBrowser from '@/Components/FileBrowser/FileBrowser.vue';
import { ref } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';

const foldersStore = useFoldersStore();

defineProps({
    appName: {
        type: String,
        required: true,
    },
});

const isLoaded = ref(false);

foldersStore.loadFolders().then(() => isLoaded.value = true);
</script>
