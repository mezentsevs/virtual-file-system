<script setup>
import { inject } from 'vue';
import FolderPanel from '@/Components/FoldersTree/FolderPanel.vue';
import FilePanel from '@/Components/FoldersTree/FilePanel.vue';

defineEmits([
    'folderDeleted',
    'fileDeleted',
]);

const item = inject('currentItem');
</script>

<template>
    <section class="item-panel m-4 ml-0 p-4 w-2/3 min-w-[400px] min-h-[600px] text-gray-500 dark:text-gray-400 border-solid border-[1px] border-gray-500 dark:border-gray-400 rounded-lg">
        <FolderPanel v-if="item.type === 'folder'" @folder-deleted="$emit('folderDeleted')" />
        <FilePanel v-else-if="item.type === 'file'" @file-deleted="$emit('fileDeleted')" />
    </section>
</template>
