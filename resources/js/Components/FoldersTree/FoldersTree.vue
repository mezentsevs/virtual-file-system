<script setup>
import ChildFolder from '@/Components/FoldersTree/ChildFolder.vue';
import Folder from '@/Components/FoldersTree/Folder.vue';

defineProps({
    folders: {
        type: Array,
        default: [],
    },
});
</script>

<template>
    <ul class="folders-tree m-4 p-4 w-1/3 min-w-[300px] min-h-[600px] text-gray-500 dark:text-gray-400 border-solid border-[1px] border-gray-500 dark:border-gray-400 rounded-lg"
        v-for="folder in folders"
        :key="folder.id"
    >
        <Folder>{{ folder.name }}</Folder>
        <ul class="children-folders pl-4 hidden" v-if="folder.children_folders.length">
            <ChildFolder v-for="childFolder in folder.children_folders" :key="childFolder.id" :child-folder />
        </ul>
    </ul>
</template>
