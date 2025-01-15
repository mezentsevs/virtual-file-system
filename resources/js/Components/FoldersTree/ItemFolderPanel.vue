<script setup>
import { inject, ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import { useFoldersStore } from '@/Stores/Folders.js';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SaveButton from '@/Components/SaveButton.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import CreateFolderButton from '@/Components/CreateFolderButton.vue';
import CreateFileButton from '@/Components/CreateFileButton.vue';

const foldersStore = useFoldersStore();

const folder = inject('currentItem');

const updateFolderFormErrors = ref({});

let isUpdateFolderNameInputChanged = false;

async function onUpdateFolderFormSubmit() {
    if (!isUpdateFolderNameInputChanged) { return; }

    updateFolderFormErrors.value = {};

    const data = await foldersStore.updateFolderById(folder.value.id, {
        name: folder.value.name,
    });

    if (data.success === false) { updateFolderFormErrors.value = data.errors; }

    isUpdateFolderNameInputChanged = false;
}
</script>

<template>
    <div class="flex flex-row justify-between items-center">
        <h3 class="h-9 text-3xl text-center truncate grow">{{ folder.name }}</h3>
        <SaveButton class="shrink-0" @click="onUpdateFolderFormSubmit" />
        <DeleteButton v-if="folder.folder_id" class="ml-2 shrink-0" />
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
            @update:model-value="isUpdateFolderNameInputChanged = true"
        />
        <InputError v-for="error in updateFolderFormErrors.name" class="mt-2" :message="error" />
    </form>

    <div class="m-16 flex flex-col items-center">
        <div class="w-1/2 flex flex-row justify-between">
            <CreateFolderButton />
            <CreateFileButton />
        </div>
    </div>
</template>
