<script setup>
import FoldersTreeChildFolder from '@/Components/FoldersTree/FoldersTreeChildFolder.vue';
import FolderIcon from '@/Icons/FolderIcon.vue';
import FoldersTreeListItem from '@/Components/FoldersTree/FoldersTreeListItem.vue';

defineProps({
    folders: {
        type: Array,
        default: [],
    },
});
</script>

<template>
    <ul class="p-4 text-gray-500 dark:text-gray-400" v-for="folder in folders" :key="folder.id">
        <FoldersTreeListItem :content="folder.name">
            <FolderIcon />
        </FoldersTreeListItem>
        <ul class="pl-4" v-if="folder.children_folders.length">
            <FoldersTreeChildFolder v-for="childFolder in folder.children_folders" :key="childFolder.id" :child-folder />
        </ul>
    </ul>
</template>
