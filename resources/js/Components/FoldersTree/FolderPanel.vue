<script setup>
import CreateFileButton from '@/Components/CreateFileButton.vue';
import CreateFileTab from '@/Components/FoldersTree/CreateFileTab.vue';
import CreateFolderButton from '@/Components/CreateFolderButton.vue';
import CreateFolderTab from '@/Components/FoldersTree/CreateFolderTab.vue';
import CustomHeader from '@/Components/CustomHeader.vue';
import CustomHeading from '@/Components/CustomHeading.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SaveButton from '@/Components/SaveButton.vue';
import Statistics from '@/Components/FoldersTree/Statistics.vue';
import TextInput from '@/Components/TextInput.vue';
import { blurAfterSubmit } from '@/Helpers/DomHelper.js';
import { formatBytes } from '@/Helpers/FormatHelper.js';
import { inject, ref, watch } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';

const foldersStore = useFoldersStore();

const emit = defineEmits(['folderDeleted']);

const folder = inject('currentItem');

const errors = ref({});

const currentTab = ref('');

const tabs = {
    folder: CreateFolderTab,
    file: CreateFileTab,
};

const name = ref('');

watch(
    () => folder.value.id,
    () => setUp(),
);

async function onSave(event) {
    errors.value = {};

    const data = await foldersStore.updateFolderById({
        id: folder.value.id,
        name: name.value,
    });

    if (data.success === false) { errors.value = data.errors; }

    blurAfterSubmit(event, 'name');
}

async function onDeleteButtonClick() {
    const data = await foldersStore.deleteFolderById({ id: folder.value.id });

    if (data.success === true) { emit('folderDeleted'); }
}

function setUp() {
    name.value = folder.value.name;

    errors.value = {};
}

setUp();
</script>

<template>
    <CustomHeader>
        <CustomHeading :level="3" class="h-9 text-3xl">{{ folder.name }}</CustomHeading>
        <SaveButton class="shrink-0" @click="onSave" />
        <DeleteButton v-if="folder.folder_id" class="ml-2 shrink-0" @click="onDeleteButtonClick" />
    </CustomHeader>

    <Statistics>
        Folders: {{ folder.folders_count }}, Files: {{ folder.files_count }}, Size: {{ formatBytes(folder.size) }}
    </Statistics>

    <form @submit.prevent="onSave">
        <InputLabel for="name" value="Name" />
        <TextInput
            id="name"
            v-model="name"
            type="text"
            class="mt-1 block w-full focus:text-gray-800 dark:focus:text-gray-200 transition-colors"
            required
            autocomplete="name"
            @focusin="name = folder.name"
        />
        <InputError v-for="error in errors.name" class="mt-2" :message="error" />
    </form>

    <div class="m-16 flex flex-col items-center">
        <div class="w-1/2 flex flex-row justify-between">
            <CreateFolderButton :class="{ 'current-tab': currentTab === 'folder' }" @click="currentTab = 'folder'" />
            <CreateFileButton :class="{ 'current-tab': currentTab === 'file' }" @click="currentTab = 'file'" />
        </div>
    </div>

    <section>
        <KeepAlive>
            <component :is="tabs[currentTab]" />
        </KeepAlive>
    </section>
</template>

<style scoped>
.image-button.current-tab {
    fill: #6366f1;
}
</style>
