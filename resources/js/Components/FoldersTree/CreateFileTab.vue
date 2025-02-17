<script setup>
import SaveButton from '@/Components/SaveButton.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { inject, ref, watch } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';
import TextArea from '@/Components/TextArea.vue';
import CustomHeader from '@/Components/CustomHeader.vue';

const foldersStore = useFoldersStore();

const folder = inject('currentItem');

const errors = ref({});

let newFileName = '';

let newFileContent = '';

watch(
    () => folder.value.id,
    () => errors.value = {},
);

async function onSaveButtonClick() {
    errors.value = {};

    const data = await foldersStore.createFile({
        folder_id: folder.value.id,
        name: newFileName,
        content: newFileContent,
    });

    if (data.success === false) { errors.value = data.errors; }
}
</script>

<template>
    <div class="flex flex-row justify-between items-center">
        <CustomHeader :level="4" class="h-8 text-2xl">Create file</CustomHeader>
        <SaveButton class="shrink-0" @click="onSaveButtonClick" />
    </div>

    <form @submit.prevent>
        <InputLabel for="new-file-name" value="New file name" />
        <TextInput
            id="new-file-name"
            v-model="newFileName"
            type="text"
            class="mt-1 block w-full"
            required
            autocomplete="new-file-name"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />

        <InputLabel for="new-file-content" value="New file content" />
        <TextArea
            id="new-file-content"
            v-model="newFileContent"
            class="mt-1 block w-full"
            rows="10"
            cols="100"
            autocomplete="new-file-content"
        />
        <InputError v-for="error in errors.content" class="mt-2" :message="error" />
    </form>
</template>
