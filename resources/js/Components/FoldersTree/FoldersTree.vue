<script setup>
import ChildFolder from '@/Components/FoldersTree/ChildFolder.vue';
import Folder from '@/Components/FoldersTree/Folder.vue';
import ItemPanel from '@/Components/FoldersTree/ItemPanel.vue';
import { provide, ref } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';
import File from '@/Components/FoldersTree/File.vue';

const foldersStore = useFoldersStore();

const props = defineProps({
    folders: {
        type: Array,
        default: [],
    },
});

const isChildrenHidden = ref(true);

const currentItem = ref({});

provide('currentItem', currentItem);

function setCurrentItem(item) {
    currentItem.value = item;
}

function onIconToggled(icon) {
    isChildrenHidden.value = (icon === 'closed');
}

function onCurrentItemDeleted() {
    setCurrentItem(foldersStore.getFolderById({ id: currentItem.value.folder_id }));

    const $folder = document.getElementById(`folder-${currentItem.value.id}`);

    if ($folder) { setFolderSelected($folder); }
}

function setFolderSelected($folder) {
    if (!$folder.classList.value.includes('selected')) {
        document.querySelectorAll('.folder')
            .forEach((folder) => folder.classList.remove('selected'));

        $folder.classList.add('selected');
    }
}

setCurrentItem(props.folders.find(folder => folder.folder_id === null));
</script>

<template>
    <div class="flex flex-row items-top justify-between">
        <div class="folders-tree m-4 w-1/3 min-w-[300px] min-h-[600px] overflow-hidden text-gray-500 dark:text-gray-400 border-solid border-[1px] border-gray-500 dark:border-gray-400 rounded-lg">
            <ul
                v-for="folder in folders"
                :key="folder.id"
                class="p-4 max-h-screen overflow-x-hidden overflow-y-auto"
            >
                <Folder :folder @item-selected="setCurrentItem" @icon-toggled="onIconToggled" />

                <ul
                    v-if="folder.children_folders.length"
                    class="children-folders pl-4"
                    :class="[isChildrenHidden ? 'hidden' : 'shown']"
                >
                    <ChildFolder
                        v-for="childFolder in folder.children_folders"
                        :key="childFolder.id"
                        :child-folder
                        @item-selected="setCurrentItem"
                    />
                </ul>

                <ul
                    v-if="folder.files.length"
                    class="files pl-4"
                    :class="[isChildrenHidden ? 'hidden' : 'shown']"
                >
                    <File
                        v-for="file in folder.files"
                        :key="file.id"
                        :file
                        @item-selected="setCurrentItem"
                    />
                </ul>
            </ul>
        </div>

        <ItemPanel @folder-deleted="onCurrentItemDeleted" @file-deleted="onCurrentItemDeleted" />
    </div>
</template>

<style scoped>
.shown {
    animation: show 0.25s ease-in-out;
}

@keyframes show {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}
</style>
