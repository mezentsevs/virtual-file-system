<script setup>
import SaveButton from '@/Components/SaveButton.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { inject, ref, watch } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';
import CustomHeading from '@/Components/CustomHeading.vue';
import CustomHeader from '@/Components/CustomHeader.vue';

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

    const data = await foldersStore.createFolder({
        folder_id: folder.value.id,
        name: newFolderName,
    });

    if (data.success === false) { errors.value = data.errors; }
}
</script>

<template>
    <CustomHeader>
        <CustomHeading :level="4" class="h-8 text-2xl">Create folder</CustomHeading>
        <SaveButton class="shrink-0" @click="onSaveButtonClick" />
    </CustomHeader>

    <form @submit.prevent>
        <InputLabel for="new-folder-name" value="New folder name" />
        <TextInput
            id="new-folder-name"
            v-model="newFolderName"
            type="text"
            class="mt-1 block w-full focus:text-gray-800 dark:focus:text-gray-200 transition-colors"
            required
            autocomplete="new-folder-name"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />
    </form>
</template>
