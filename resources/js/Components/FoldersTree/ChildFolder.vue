<script setup>
import ChildFolder from '@/Components/FoldersTree/ChildFolder.vue';
import Folder from '@/Components/FoldersTree/Folder.vue';
import { ref } from 'vue';

defineProps({
    childFolder: {
        type: Object,
        default: {},
    },
});

defineEmits(['itemSelected']);

const isChildrenFoldersHidden = ref(true);

function onIconToggled(icon) {
    isChildrenFoldersHidden.value = (icon === 'closed');
}
</script>

<template>
    <Folder
        :folder="childFolder"
        @item-selected="(item) => $emit('itemSelected', item)"
        @icon-toggled="onIconToggled"
    />

    <ul
        v-if="childFolder.children_folders.length"
        class="children-folders pl-4"
        :class="{ hidden: isChildrenFoldersHidden }"
    >
        <ChildFolder
            v-for="childFolder in childFolder.children_folders"
            :key="childFolder.id"
            :child-folder
            @item-selected="(item) => $emit('itemSelected', item)"
        />
    </ul>
</template>
