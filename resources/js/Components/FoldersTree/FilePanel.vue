<template>
    <CustomHeader>
        <CustomHeading :level="3" class="h-9 text-3xl">{{ file.name }}</CustomHeading>
        <SaveButton class="shrink-0" @click="onSave" />
        <DeleteButton class="ml-2 shrink-0" @click="onDeleteButtonClick" />
    </CustomHeader>

    <Statistics>Size: {{ formatBytes(file.size) }}</Statistics>

    <form @submit.prevent="onSave">
        <InputLabel for="name" value="Name" />
        <TextInput
            id="name"
            v-model="name"
            type="text"
            class="mt-1 block w-full focus:text-gray-800 dark:focus:text-gray-200 transition-colors"
            required
            autocomplete="name"
            @focusin="name = file.name"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />

        <InputLabel for="content" value="Content" class="mt-1" />
        <TextArea
            id="content"
            v-model="content"
            class="mt-1 block w-full focus:text-gray-800 dark:focus:text-gray-200 transition-colors"
            rows="10"
            cols="100"
            autocomplete="content"
        />
        <InputError v-for="error in errors.content" class="mt-2" :message="error" />
    </form>
</template>

<script setup>
import CustomHeader from '@/Components/CustomHeader.vue';
import CustomHeading from '@/Components/CustomHeading.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SaveButton from '@/Components/SaveButton.vue';
import Statistics from '@/Components/FoldersTree/Statistics.vue';
import TextArea from '@/Components/TextArea.vue';
import TextInput from '@/Components/TextInput.vue';
import { blurAfterSubmit } from '@/Helpers/DomHelper.js';
import { formatBytes } from '@/Helpers/FormatHelper.js';
import { inject, ref, watch } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';

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

async function onSave(event) {
    errors.value = {};

    const data = await foldersStore.updateFileById({
        id: file.value.id,
        name: name.value,
        content: content.value,
    });

    if (data.success === false) { errors.value = data.errors; }

    blurAfterSubmit(event, 'name');
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
