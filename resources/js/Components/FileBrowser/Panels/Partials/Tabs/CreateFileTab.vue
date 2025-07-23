<template>
    <Header>
        <Heading :level="4" class="h-8 text-2xl">Create file</Heading>
        <SaveButton class="shrink-0" @click="onSave" />
    </Header>

    <form @submit.prevent="onSave">
        <InputLabel for="new-file-name" value="New file name" />
        <TextInput
            id="new-file-name"
            v-model="newFileName"
            type="text"
            class="block w-full mt-1 focus:text-gray-800 dark:focus:text-gray-200 transition-colors"
            required
            autocomplete="new-file-name"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />

        <InputLabel for="new-file-content" value="New file content" class="mt-1" />
        <TextArea
            id="new-file-content"
            v-model="newFileContent"
            class="block w-full mt-1 focus:text-gray-800 dark:focus:text-gray-200 transition-colors"
            rows="10"
            cols="100"
            autocomplete="new-file-content"
        />
        <InputError v-for="error in errors.content" class="mt-2" :message="error" />
    </form>
</template>

<script setup>
import Header from '@/Components/Uikit/Headers/Header.vue';
import Heading from '@/Components/Uikit/Headings/Heading.vue';
import InputError from '@/Components/Uikit/Inputs/Partials/InputError.vue';
import InputLabel from '@/Components/Uikit/Inputs/Partials/InputLabel.vue';
import SaveButton from '@/Components/Uikit/Buttons/SaveButton.vue';
import TextArea from '@/Components/Uikit/Inputs/TextArea.vue';
import TextInput from '@/Components/Uikit/Inputs/TextInput.vue';
import { blurAfterSubmit } from '@/Helpers/DomHelper.js';
import { inject, ref, watch } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';

const foldersStore = useFoldersStore();

const folder = inject('currentItem');

const errors = ref({});

let newFileName = '';

let newFileContent = '';

watch(
    () => folder.value.id,
    () => errors.value = {},
);

const onSave = async event => {
    errors.value = {};

    const data = await foldersStore.createFile({
        folder_id: folder.value.id,
        name: newFileName,
        content: newFileContent,
    });

    if (data.success === false) { errors.value = data.errors; }

    blurAfterSubmit(event, 'new-file-name');
};
</script>
