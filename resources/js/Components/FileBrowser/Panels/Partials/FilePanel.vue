<template>
    <Header>
        <Heading :level="3" class="h-9 text-3xl">{{ file.name }}</Heading>
        <SaveButton class="shrink-0" @click="onSave" />
        <DeleteButton class="ml-2 shrink-0" @click="onDeleteButtonClick" />
    </Header>

    <FoldersTreeItemStatistics>Size: {{ formatBytes(file.size) }}</FoldersTreeItemStatistics>

    <form @submit.prevent="onSave">
        <InputLabel for="name" value="Name" />
        <TextInput
            id="name"
            v-model="name"
            type="text"
            class="block w-full mt-1 focus:text-gray-800 dark:focus:text-gray-200 transition-colors"
            required
            autocomplete="name"
            @focusin="name = file.name"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />

        <InputLabel for="content" value="Content" class="mt-1" />
        <TextArea
            id="content"
            v-model="content"
            class="block w-full mt-1 focus:text-gray-800 dark:focus:text-gray-200 transition-colors"
            rows="10"
            cols="100"
            autocomplete="content"
        />
        <InputError v-for="error in errors.content" class="mt-2" :message="error" />
    </form>
</template>

<script setup>
import DeleteButton from '@/Components/Uikit/Buttons/DeleteButton.vue';
import FoldersTreeItemStatistics from '@/Components/FileBrowser/Panels/Partials/Statistics/FoldersTreeItemStatistics.vue';
import Header from '@/Components/Uikit/Headers/Header.vue';
import Heading from '@/Components/Uikit/Headings/Heading.vue';
import InputError from '@/Components/Uikit/Inputs/Partials/InputError.vue';
import InputLabel from '@/Components/Uikit/Inputs/Partials/InputLabel.vue';
import SaveButton from '@/Components/Uikit/Buttons/SaveButton.vue';
import TextArea from '@/Components/Uikit/Inputs/TextArea.vue';
import TextInput from '@/Components/Uikit/Inputs/TextInput.vue';
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

const onSave = async event => {
    errors.value = {};

    const data = await foldersStore.updateFileById({
        id: file.value.id,
        name: name.value,
        content: content.value,
    });

    if (data.success === false) { errors.value = data.errors; }

    blurAfterSubmit(event, 'name');
};

const onDeleteButtonClick = async () => {
    const data = await foldersStore.deleteFileById({ id: file.value.id });

    if (data.success === true) { emit('fileDeleted'); }
};

const setUp = () => {
    name.value = file.value.name;

    content.value = file.value.content;

    errors.value = {};
};

setUp();
</script>
