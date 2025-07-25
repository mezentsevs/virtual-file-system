<template>
    <nav
        class="folders-tree w-1/3 min-w-[300px] min-h-[600px] m-4 border border-solid border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 overflow-hidden rounded-lg"
    >
        <ul
            v-for="folder in folders"
            :key="folder.id"
            class="max-h-screen p-4 overflow-x-hidden overflow-y-auto"
        >
            <Folder :folder @item-selected="onItemSelected" @icon-toggled="onIconToggled" />

            <ul
                v-if="folder.children_folders.length"
                class="children-folders pl-4"
                :class="[isChildrenHidden ? 'hidden' : 'shown']"
            >
                <ChildFolder
                    v-for="childFolder in folder.children_folders"
                    :key="childFolder.id"
                    :child-folder
                    @item-selected="onItemSelected"
                />
            </ul>

            <ul
                v-if="folder.files.length"
                class="files pl-4"
                :class="[isChildrenHidden ? 'hidden' : 'shown']"
            >
                <File
                    v-for="file in folder.files"
                    :key="file.id"
                    :file
                    @item-selected="onItemSelected"
                />
            </ul>
        </ul>
    </nav>
</template>

<script setup>
import ChildFolder from '@/Components/FileBrowser/FoldersTree/Partials/Items/ChildFolder.vue';
import File from '@/Components/FileBrowser/FoldersTree/Partials/Items/File.vue';
import Folder from '@/Components/FileBrowser/FoldersTree/Partials/Items/Folder.vue';
import { ref, defineProps, defineEmits } from 'vue';
import { useSelection } from '@/Composables/SelectionComposable.js';

const props = defineProps({
    folders: {
        type: Array,
        default: [],
    },
});

const emit = defineEmits(['item-selected']);

const { setSelected } = useSelection();

const isChildrenHidden = ref(true);

const onItemSelected = item => {
    setSelectedItem(item);
    emit('item-selected', item);
};

const onIconToggled = icon => (isChildrenHidden.value = icon === 'closed');

const setSelectedItem = item => {
    const selector = item.type === 'folder' ? `#folder-${item.id}` : `#file-${item.id}`;

    const $el = document.querySelector(selector);

    if ($el) {
        setSelected($el);
    }
};

defineExpose({
    setSelectedItem,
});
</script>
