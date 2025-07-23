<template>
    <Header>
        <Heading :level="3" class="h-9 text-3xl">{{ folder.name }}</Heading>
        <SaveButton class="shrink-0" @click="onSave" />
        <DeleteButton v-if="folder.folder_id" class="ml-2 shrink-0" @click="onDeleteButtonClick" />
    </Header>

    <FoldersTreeItemStatistics>
        Folders: {{ folder.folders_count }}, Files: {{ folder.files_count }}, Size: {{ formatBytes(folder.size) }}
    </FoldersTreeItemStatistics>

    <form @submit.prevent="onSave">
        <InputLabel for="name" value="Name" />
        <TextInput
            id="name"
            v-model="name"
            type="text"
            class="block w-full mt-1 focus:text-gray-800 dark:focus:text-gray-200 transition-colors"
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

<script setup>
import CreateFileButton from '@/Components/Uikit/Buttons/CreateFileButton.vue';
import CreateFileTab from '@/Components/FileBrowser/Panels/Partials/Tabs/CreateFileTab.vue';
import CreateFolderButton from '@/Components/Uikit/Buttons/CreateFolderButton.vue';
import CreateFolderTab from '@/Components/FileBrowser/Panels/Partials/Tabs/CreateFolderTab.vue';
import DeleteButton from '@/Components/Uikit/Buttons/DeleteButton.vue';
import FoldersTreeItemStatistics from '@/Components/FileBrowser/Panels/Partials/Statistics/FoldersTreeItemStatistics.vue';
import Header from '@/Components/Uikit/Headers/Header.vue';
import Heading from '@/Components/Uikit/Headings/Heading.vue';
import InputError from '@/Components/Uikit/Inputs/Partials/InputError.vue';
import InputLabel from '@/Components/Uikit/Inputs/Partials/InputLabel.vue';
import SaveButton from '@/Components/Uikit/Buttons/SaveButton.vue';
import TextInput from '@/Components/Uikit/Inputs/TextInput.vue';
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

const onSave = async event => {
    errors.value = {};

    const data = await foldersStore.updateFolderById({
        id: folder.value.id,
        name: name.value,
    });

    if (data.success === false) { errors.value = data.errors; }

    blurAfterSubmit(event, 'name');
};

const onDeleteButtonClick = async () => {
    const data = await foldersStore.deleteFolderById({ id: folder.value.id });

    if (data.success === true) { emit('folderDeleted'); }
};

const setUp = () => {
    name.value = folder.value.name;

    errors.value = {};
};

setUp();
</script>

<style scoped>
.image-button.current-tab {
    @apply fill-indigo-500;
}
</style>
