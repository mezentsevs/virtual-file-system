<script setup>
import { inject, ref, watch } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SaveButton from '@/Components/SaveButton.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import { useFoldersStore } from '@/Stores/Folders.js';
import TextArea from '@/Components/TextArea.vue';
import { formatBytes } from '@/Helpers/FormatHelper.js';
import CustomHeading from '@/Components/CustomHeading.vue';

const foldersStore = useFoldersStore();

const emit = defineEmits(['fileDeleted']);

const file = inject('currentItem');

const errors = ref({});

const name = ref('');

const content = ref('');

watch(
    () => file.value.id,
    () => setUp(),
);

async function onSaveButtonClick() {
    errors.value = {};

    const data = await foldersStore.updateFileById({
        id: file.value.id,
        name: name.value,
        content: content.value,
    });

    if (data.success === false) { errors.value = data.errors; }
}

async function onDeleteButtonClick() {
    const data = await foldersStore.deleteFileById({ id: file.value.id });

    if (data.success === true) { emit('fileDeleted'); }
}

function setUp() {
    name.value = file.value.name;

    content.value = file.value.content;

    errors.value = {};
}

setUp();
</script>

<template>
    <div class="flex flex-row justify-between items-center">
        <CustomHeading :level="3" class="h-9 text-3xl">{{ file.name }}</CustomHeading>
        <SaveButton class="shrink-0" @click="onSaveButtonClick" />
        <DeleteButton class="ml-2 shrink-0" @click="onDeleteButtonClick" />
    </div>

    <div class="my-2 text-sm text-gray-400 dark:text-gray-600">
        Size: {{ formatBytes(file.size) }}
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
            @focusin="name = file.name"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />

        <InputLabel for="content" value="Content" class="mt-1" />
        <TextArea
            id="content"
            v-model="content"
            class="mt-1 block w-full"
            rows="10"
            cols="100"
            autocomplete="content"
        />
        <InputError v-for="error in errors.content" class="mt-2" :message="error" />
    </form>
</template>
