<script setup>
import ChildFolder from '@/Components/FoldersTree/ChildFolder.vue';
import Folder from '@/Components/FoldersTree/Folder.vue';
import { ref } from 'vue';
import File from '@/Components/FoldersTree/File.vue';

defineProps({
    childFolder: {
        type: Object,
        default: {},
    },
});

defineEmits(['itemSelected']);

const isChildrenHidden = ref(true);

function onIconToggled(icon) {
    isChildrenHidden.value = (icon === 'closed');
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
        :class="[isChildrenHidden ? 'hidden' : 'shown']"
    >
        <ChildFolder
            v-for="childFolder in childFolder.children_folders"
            :key="childFolder.id"
            :child-folder
            @item-selected="(item) => $emit('itemSelected', item)"
        />
    </ul>

    <ul
        v-if="childFolder.files.length"
        class="files pl-4"
        :class="[isChildrenHidden ? 'hidden' : 'shown']"
    >
        <File
            v-for="file in childFolder.files"
            :key="file.id"
            :file
            @item-selected="(item) => $emit('itemSelected', item)"
        />
    </ul>
</template>

<style scoped>
.shown {
    animation: appearance 0.25s ease-in-out;
}

@keyframes appearance {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}
</style>
