<script setup>
import { inject, ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import SaveFloppyIcon from '@/Icons/SaveFloppyIcon.vue';
import { useFoldersStore } from '@/Stores/Folders.js';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SaveButton from '@/Components/SaveButton.vue';

const foldersStore = useFoldersStore();

const folder = inject('currentItem');

const updateFolderFormErrors = ref({});

async function onUpdateFolderFormSubmit() {
    updateFolderFormErrors.value = {};

    const data = await foldersStore.updateFolderById(folder.value.id, {
        name: folder.value.name,
    });

    if (data.success === false) { updateFolderFormErrors.value = data.errors; }
}
</script>

<template>
    <form @submit.prevent>
        <div>
            <InputLabel for="name" value="Name" />
            <TextInput
                id="name"
                v-model="folder.name"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="name"
            />
            <InputError v-for="error in updateFolderFormErrors.name" class="mt-2" :message="error" />
        </div>

        <SaveButton @click="onUpdateFolderFormSubmit" />
    </form>
</template>
