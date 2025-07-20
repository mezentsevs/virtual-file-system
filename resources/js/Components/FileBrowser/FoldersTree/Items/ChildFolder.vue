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

<script setup>
import ChildFolder from '@/Components/FileBrowser/FoldersTree/Items/ChildFolder.vue';
import File from '@/Components/FileBrowser/FoldersTree/Items/File.vue';
import Folder from '@/Components/FileBrowser/FoldersTree/Items/Folder.vue';
import { ref } from 'vue';

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
