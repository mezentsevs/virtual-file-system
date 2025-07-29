<template>
    <div class="flex flex-row items-top justify-between">
        <FoldersTree ref="foldersTreeRef" :folders @item-selected="setCurrentItem" />

        <FoldersTreeItemPanel
            @folder-deleted="onCurrentItemDeleted"
            @file-deleted="onCurrentItemDeleted" />
    </div>
</template>

<script setup>
import FoldersTree from '@/Components/FileBrowser/FoldersTree/FoldersTree.vue';
import FoldersTreeItemPanel from '@/Components/FileBrowser/Panels/FoldersTreeItemPanel.vue';
import { provide, ref } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';

const foldersStore = useFoldersStore();

const props = defineProps({
    folders: {
        type: Array,
        default: [],
    },
});

const currentItem = ref({});
const foldersTreeRef = ref(null);

provide('currentItem', currentItem);

const setCurrentItem = item => (currentItem.value = item);

const onCurrentItemDeleted = () => {
    const parentFolder = foldersStore.getFolderById({ id: currentItem.value.folder_id });
    setCurrentItem(parentFolder);
    foldersTreeRef.value.setSelectedItem(parentFolder);
};

setCurrentItem(props.folders.find(folder => folder.folder_id === null));
</script>
