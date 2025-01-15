<script setup>
import { inject, ref } from 'vue';
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

const folder = inject('currentItem');

const errors = ref({});

const currentTab = ref('');

const tabs = {
    folder: CreateFolderTab,
    file: CreateFileTab,
};

let isNameChanged = false;

async function onSaveButtonClick() {
    if (!isNameChanged) { return; }

    errors.value = {};

    let data = {};

    try {
        const response = await axios.patch(`/api/folders/${folder.value.id}`, {
            name: folder.value.name,
        });

        if (response.status === 200) { data = response.data; }
    } catch (error) {
        if (error.status === 422) { data = error.response.data; }
    }

    if (data.success === false) { errors.value = data.errors; }

    isNameChanged = false;
}

async function onDeleteButtonClick() {
    const response = await axios.delete(`/api/folders/${folder.value.id}`);

    if (response.status === 200 && response.data.success === true) {
        await foldersStore.loadFolders();
    }
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
            v-model="folder.name"
            type="text"
            class="mt-1 block w-full"
            required
            autocomplete="name"
            @update:model-value="isNameChanged = true"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />
    </form>

    <div class="m-16 flex flex-col items-center">
        <div class="w-1/2 flex flex-row justify-between">
            <CreateFolderButton @click="currentTab = 'folder'" />
            <CreateFileButton @click="currentTab = 'file'" />
        </div>
    </div>

    <component :is="tabs[currentTab]" />
</template>
