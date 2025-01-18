<script setup>
import { inject, ref, watch } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SaveButton from '@/Components/SaveButton.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import CreateFolderButton from '@/Components/CreateFolderButton.vue';
import CreateFileButton from '@/Components/CreateFileButton.vue';
import CreateFolderTab from '@/Components/FoldersTree/CreateFolderTab.vue';
import CreateFileTab from '@/Components/FoldersTree/CreateFileTab.vue';
import { useFoldersStore } from '@/Stores/Folders.js';

const foldersStore = useFoldersStore();

const emit = defineEmits([
    'folderDeleted',
]);

const folder = inject('currentItem');

const errors = ref({});

const currentTab = ref('');

const tabs = {
    folder: CreateFolderTab,
    file: CreateFileTab,
};

const name = ref('');

watch(
    () => folder.value.name,
    newName => {
        name.value = newName;

        errors.value = {};
    },
);

async function onSaveButtonClick() {
    errors.value = {};

    const data = await foldersStore.updateFolderById()({
        id: folder.value.id,
        name: name.value,
    });

    if (data.success === false) { errors.value = data.errors; }

    if (data.success === true) { name.value = ''; }
}

async function onDeleteButtonClick() {
    const data = await foldersStore.deleteFolderById()({ id: folder.value.id });

    if (data.success === true) { emit('folderDeleted'); }
}
</script>

<template>
    <div class="flex flex-row justify-between items-center">
        <h3 class="h-9 text-3xl text-center truncate grow">{{ folder.name }}</h3>
        <SaveButton class="shrink-0" @click="onSaveButtonClick" />
        <DeleteButton v-if="folder.folder_id" class="ml-2 shrink-0" @click="onDeleteButtonClick" />
    </div>

    <form @submit.prevent>
        <InputLabel for="name" value="Name" />
        <TextInput
            id="name"
            v-model="name"
            type="text"
            class="mt-1 block w-full"
            required
            autocomplete="name"
            @focusin="name = folder.name"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />
    </form>

    <div class="m-16 flex flex-col items-center">
        <div class="w-1/2 flex flex-row justify-between">
            <CreateFolderButton :class="{ 'fill-indigo-500': currentTab === 'folder' }" @click="currentTab = 'folder'" />
            <CreateFileButton :class="{ 'fill-indigo-500': currentTab === 'file' }" @click="currentTab = 'file'" />
        </div>
    </div>

    <component :is="tabs[currentTab]" />
</template>
