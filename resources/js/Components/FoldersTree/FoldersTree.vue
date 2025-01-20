<script setup>
import ChildFolder from '@/Components/FoldersTree/ChildFolder.vue';
import Folder from '@/Components/FoldersTree/Folder.vue';
import ItemPanel from '@/Components/FoldersTree/ItemPanel.vue';
import { provide, ref } from 'vue';
import { useFoldersStore } from '@/Stores/Folders.js';

const foldersStore = useFoldersStore();

const props = defineProps({
    folders: {
        type: Array,
        default: [],
    },
});

const isChildrenFoldersHidden = ref(true);

const currentItem = ref({});

provide('currentItem', currentItem);

function setCurrentItem(item) {
    currentItem.value = item;
}

function onIconToggled(icon) {
    isChildrenFoldersHidden.value = (icon === 'closed');
}

function onFolderDeleted() {
    setCurrentItem(foldersStore.getFolderById()({ id: currentItem.value.folder_id }));

    const $folder = document.getElementById(`folder-${currentItem.value.id}`);

    if ($folder) { setFolderSelected($folder) }
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
                    :class="{ hidden: isChildrenFoldersHidden }"
                >
                    <ChildFolder
                        v-for="childFolder in folder.children_folders"
                        :key="childFolder.id"
                        :child-folder
                        @item-selected="setCurrentItem"
                    />
                </ul>
            </ul>
        </div>

        <ItemPanel @folder-deleted="onFolderDeleted" />
    </div>
</template>
