<template>
    <section
        class="item-panel w-2/3 min-w-[400px] min-h-[600px] m-4 ml-0 p-4 border border-solid border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-400 rounded-lg">
        <FolderPanel v-if="item.type === 'folder'" @folder-deleted="$emit('folderDeleted')" />
        <FilePanel v-else-if="item.type === 'file'" @file-deleted="$emit('fileDeleted')" />
    </section>
</template>

<script setup>
import FilePanel from '@/Components/FileBrowser/Panels/Partials/FilePanel.vue';
import FolderPanel from '@/Components/FileBrowser/Panels/Partials/FolderPanel.vue';
import { inject } from 'vue';

defineEmits(['folderDeleted', 'fileDeleted']);

const item = inject('currentItem');
</script>
