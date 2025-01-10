<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FoldersTree from '@/Components/FoldersTree/FoldersTree.vue';
import { useFoldersStore } from '@/Stores/Folders.js';
import { onMounted, ref } from 'vue';
import FoldersTreeItemPanel from '@/Components/FoldersTree/FoldersTreeItemPanel.vue';

const foldersStore = useFoldersStore();
const isLoaded = ref(false);

onMounted(() => {
    foldersStore.fetchFolders()
        .then(() => isLoaded.value = true);
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Virtual file system
            </h2>
        </template>

        <div class="py-12" v-if="isLoaded">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg flex flex-row items-top justify-between">
                    <FoldersTree :folders="foldersStore.folders" />
                    <FoldersTreeItemPanel />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
