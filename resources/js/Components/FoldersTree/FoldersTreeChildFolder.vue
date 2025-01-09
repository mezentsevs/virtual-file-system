<script setup>
import FoldersTreeChildFolder from '@/Components/FoldersTree/FoldersTreeChildFolder.vue';
import FolderIcon from '@/Icons/FolderIcon.vue';
import FoldersTreeListItem from '@/Components/FoldersTree/FoldersTreeListItem.vue';

defineProps({
    childFolder: {
        type: Array,
        default: [],
    },
});
</script>

<template>
    <FoldersTreeListItem :content="childFolder.name">
        <FolderIcon />
    </FoldersTreeListItem>
    <ul class="pl-4" v-if="childFolder.children_folders.length">
        <FoldersTreeChildFolder v-for="childFolder in childFolder.children_folders" :child-folder />
    </ul>
</template>
