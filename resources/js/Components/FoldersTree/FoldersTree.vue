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
    <ul class="folders-tree p-4 text-gray-500 dark:text-gray-400" v-for="folder in folders" :key="folder.id">
        <Folder>{{ folder.name }}</Folder>
        <ul class="children-folders pl-4 hidden" v-if="folder.children_folders.length">
            <ChildFolder v-for="childFolder in folder.children_folders" :key="childFolder.id" :child-folder />
        </ul>
    </ul>
</template>
