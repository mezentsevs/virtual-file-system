<template>
    <CustomHeader>
        <CustomHeading :level="4" class="h-8 text-2xl">Create folder</CustomHeading>
        <SaveButton class="shrink-0" @click="onSave" />
    </CustomHeader>

    <form @submit.prevent="onSave">
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

<script setup>
import CustomHeader from '@/Components/CustomHeader.vue';
import CustomHeading from '@/Components/CustomHeading.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SaveButton from '@/Components/SaveButton.vue';
import TextInput from '@/Components/TextInput.vue';
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
