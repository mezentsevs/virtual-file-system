<script setup>
import ChildFolder from '@/Components/FoldersTree/ChildFolder.vue';

const props = defineProps({
    childFolder: {
        type: Array,
        default: [],
    },
});
</script>

<template>
    <li>{{ childFolder.name }}</li>
    <ul class="pl-4" v-if="childFolder.children_folders.length">
        <ChildFolder v-for="childFolder in childFolder.children_folders" :child-folder />
    </ul>
</template>
