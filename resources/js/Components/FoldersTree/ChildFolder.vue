<script setup>
import ChildFolder from '@/Components/FoldersTree/ChildFolder.vue';
import Folder from '@/Components/FoldersTree/Folder.vue';

defineProps({
    childFolder: {
        type: Array,
        default: [],
    },
});
</script>

<template>
    <Folder>{{ childFolder.name }}</Folder>
    <ul class="children-folders pl-4 hidden" v-if="childFolder.children_folders.length">
        <ChildFolder v-for="childFolder in childFolder.children_folders" :child-folder />
    </ul>
</template>
