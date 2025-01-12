<script setup>
import { inject } from 'vue';
import ItemFolderPanel from '@/Components/FoldersTree/ItemFolderPanel.vue';
import ItemFilePanel from '@/Components/FoldersTree/ItemFilePanel.vue';

const item = inject('currentItem');
</script>

<template>
    <div class="item-panel m-4 ml-0 p-4 w-2/3 min-w-[400px] min-h-[600px] text-gray-500 dark:text-gray-400 border-solid border-[1px] border-gray-500 dark:border-gray-400 rounded-lg">
        <ItemFolderPanel v-if="item.type === 'folder'" />
        <ItemFilePanel v-else-if="item.type === 'file'" />
    </div>
</template>
