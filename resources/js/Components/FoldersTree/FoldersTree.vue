<script setup>
import ChildFolder from '@/Components/FoldersTree/ChildFolder.vue';
import Folder from '@/Components/FoldersTree/Folder.vue';
import ItemPanel from '@/Components/FoldersTree/ItemPanel.vue';
import { ref } from 'vue';

const props = defineProps({
    folders: {
        type: Array,
        default: [],
    },
});

const currentItem = ref([]);

function setCurrentItem(item) {
    currentItem.value = item;
}

setCurrentItem(props.folders.find((folder) => folder.folder_id === null));
</script>

<template>
    <div class="flex flex-row items-top justify-between">
        <ul class="folders-tree m-4 p-4 w-1/3 min-w-[300px] min-h-[600px] overflow-hidden text-gray-500 dark:text-gray-400 border-solid border-[1px] border-gray-500 dark:border-gray-400 rounded-lg"
            v-for="folder in folders"
            :key="folder.id"
        >
            <Folder :folder @item-selected="setCurrentItem" />
            <ul class="children-folders pl-4 hidden" v-if="folder.children_folders.length">
                <ChildFolder
                    v-for="childFolder in folder.children_folders"
                    :key="childFolder.id"
                    :child-folder
                    @item-selected="setCurrentItem"
                />
            </ul>
        </ul>

        <ItemPanel :item="currentItem" />
    </div>
</template>
