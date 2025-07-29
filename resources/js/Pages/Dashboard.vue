<template>
    <AppLayout title="Dashboard" class="min-w-[1024px]">
        <template #header>
            <h2 class="text-gray-800 dark:text-gray-200 text-xl font-semibold leading-tight">
                {{ appName }}
            </h2>
        </template>

        <section v-if="foldersLoadingStatus === 'loaded'" class="flex justify-center">
            <FileBrowser
                :folders="foldersStore.folders"
                class="w-full max-w-5xl m-12 bg-white dark:bg-gray-800 overflow-hidden rounded-2xl shadow-md" />
        </section>

        <section v-else-if="foldersLoadingStatus === 'error'" class="flex justify-center">
            <div
                class="w-full max-w-5xl m-12 p-8 bg-white dark:bg-gray-800 text-center rounded-2xl shadow-md">
                <ErrorMessage>Failed to load data. Please try again later.</ErrorMessage>

                <PrimaryButton class="mt-4" @click="loadFolders">Retry</PrimaryButton>
            </div>
        </section>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ErrorMessage from '@/Components/Uikit/Messages/ErrorMessage.vue';
import FileBrowser from '@/Components/FileBrowser/FileBrowser.vue';
import PrimaryButton from '@/Components/Uikit/Buttons/PrimaryButton.vue';
import { ref } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';

const foldersStore = useFoldersStore();

defineProps({
    appName: {
        type: String,
        required: true,
    },
});

const foldersLoadingStatus = ref('');

const loadFolders = () => {
    foldersLoadingStatus.value = 'loading';

    foldersStore
        .loadFolders()
        .then(() => (foldersLoadingStatus.value = 'loaded'))
        .catch(() => (foldersLoadingStatus.value = 'error'));
};

loadFolders();
</script>
