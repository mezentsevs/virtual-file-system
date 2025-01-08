<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FoldersTree from '@/Components/FoldersTree/FoldersTree.vue';
import Welcome from '@/Components/Welcome.vue';
import { useFoldersStore } from '@/Stores/Folders.js';
import { onMounted } from 'vue';

const foldersStore = useFoldersStore();

onMounted(() => {
    foldersStore.fetchFolders();
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div>
    </AppLayout>

    <FoldersTree :folders="foldersStore.folders" />
</template>
