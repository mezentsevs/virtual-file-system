<template>
    <Header>
        <Heading :level="4" class="h-8 text-2xl">Create folder</Heading>
        <SaveButton class="shrink-0" @click="onSave" />
    </Header>

    <form @submit.prevent="onSave">
        <InputLabel for="new-folder-name" value="New folder name" />
        <TextInput
            id="new-folder-name"
            v-model="newFolderName"
            type="text"
            class="block w-full mt-1 focus:text-gray-800 dark:focus:text-gray-200 transition-colors"
            required
            autocomplete="new-folder-name"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />
    </form>
</template>

<script setup>
import Header from '@/Components/Uikit/Headers/Header.vue';
import Heading from '@/Components/Uikit/Headings/Heading.vue';
import InputError from '@/Components/Uikit/Inputs/Partials/InputError.vue';
import InputLabel from '@/Components/Uikit/Inputs/Partials/InputLabel.vue';
import SaveButton from '@/Components/Uikit/Buttons/SaveButton.vue';
import TextInput from '@/Components/Uikit/Inputs/TextInput.vue';
import { blurAfterSubmit } from '@/Helpers/DomHelper.js';
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

async function onSave(event) {
    errors.value = {};

    const data = await foldersStore.createFolder({
        folder_id: folder.value.id,
        name: newFolderName,
    });

    if (data.success === false) { errors.value = data.errors; }

    blurAfterSubmit(event, 'new-folder-name');
}
</script>
