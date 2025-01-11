<script setup>
import ChildFolder from '@/Components/FoldersTree/ChildFolder.vue';
import Folder from '@/Components/FoldersTree/Folder.vue';

defineProps({
    childFolder: {
        type: Array,
        default: [],
    },
});

defineEmits(['itemSelected']);
</script>

<template>
    <Folder :folder="childFolder" @item-selected="(item) => $emit('itemSelected', item)" />
    <ul class="children-folders pl-4 hidden" v-if="childFolder.children_folders.length">
        <ChildFolder
            v-for="childFolder in childFolder.children_folders"
            :key="childFolder.id"
            :child-folder
            @item-selected="(item) => $emit('itemSelected', item)"
        />
    </ul>
</template>
