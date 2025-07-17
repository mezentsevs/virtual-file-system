<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-gray-800 dark:text-gray-200 text-xl font-semibold leading-tight">
                {{ appName }}
            </h2>
        </template>

        <div class="py-12" v-if="isLoaded">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg shadow-xl">
                    <FoldersTree :folders="foldersStore.folders" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FoldersTree from '@/Components/FoldersTree/FoldersTree.vue';
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
