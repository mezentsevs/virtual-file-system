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
        :class="{ hidden: isChildrenHidden }"
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
        :class="{ hidden: isChildrenHidden }"
    >
        <File
            v-for="file in childFolder.files"
            :key="file.id"
            :file
            @item-selected="(item) => $emit('itemSelected', item)"
        />
    </ul>
</template>
