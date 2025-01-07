<script setup>
import ChildFolder from '@/Components/FoldersTree/ChildFolder.vue';

const props = defineProps({
    folders: {
        type: Array,
        default: [],
    },
});
</script>

<template>
    <ul class="pl-4" v-for="folder in folders" :key="folder.id">
        <li>{{ folder.name }}</li>
        <ul class="pl-4" v-if="folder.children_folders.length">
            <ChildFolder v-for="childFolder in folder.children_folders" :key="childFolder.id" :child-folder />
        </ul>
    </ul>
</template>
