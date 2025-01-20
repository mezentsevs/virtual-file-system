<script setup>
import SaveButton from '@/Components/SaveButton.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { inject, ref, watch } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';

const foldersStore = useFoldersStore();

const folder = inject('currentItem');

const errors = ref({});

let newFolderName = '';

watch(
    () => folder.value.id,
    () => errors.value = {},
);

async function onSaveButtonClick() {
    errors.value = {};

    const data = await foldersStore.createFolder()({
        folder_id: folder.value.id,
        name: newFolderName,
    });

    if (data.success === false) { errors.value = data.errors; }
}
</script>

<template>
    <div class="flex flex-row justify-between items-center">
        <h4 class="h-8 text-2xl text-center truncate grow">Create folder</h4>
        <SaveButton class="shrink-0" @click="onSaveButtonClick" />
    </div>

    <form @submit.prevent>
        <InputLabel for="new-folder-name" value="New folder name" />
        <TextInput
            id="new-folder-name"
            v-model="newFolderName"
            type="text"
            class="mt-1 block w-full"
            required
            autocomplete="new-folder-name"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />
    </form>
</template>
