<script setup>
import { getNextSiblingBySelector } from '@/Helpers/QueryHelper.js';
import FolderIcon from '@/Icons/FolderIcon.vue';
import FolderOpenIcon from '@/Icons/FolderOpenIcon.vue';
import { ref } from 'vue';

const props = defineProps({
    folder: {
        type: Array,
        default: [],
    },
});

const emit = defineEmits(['itemSelected']);

const currentIcon = ref('closed');

const icons = {
    closed: FolderIcon,
    opened: FolderOpenIcon,
};

function onFolderClick(event) {
    toggleIcon();

    const $folder = event.target.closest('.folder');

    toggleChildrenFolders($folder);

    setBackground($folder);

    emit('itemSelected', props.folder);
}

function toggleIcon() {
    currentIcon.value = currentIcon.value === 'closed' ? 'opened' : 'closed';
}

function toggleChildrenFolders($folder) {
    const $childrenFolders = getNextSiblingBySelector($folder, '.children-folders');

    if ($childrenFolders) {
        $childrenFolders.classList.toggle('hidden');
    }
}

function setBackground($folder) {
    if (!$folder.classList.value.includes('selected')) {
        document.querySelectorAll('.folder')
            .forEach((folder) => folder.classList.remove('selected'));

        $folder.classList.add('selected');
    }
}
</script>

<template>
    <li class="folder flex flex-row items-center" @click="onFolderClick">
        <div class="inline-block w-[25px] h-[25px] shrink-0 cursor-pointer fill-gray-500 dark:fill-gray-400 hover:fill-indigo-600">
            <component :is="icons[currentIcon]" />
        </div>
        <span class="inline-block ml-[5px] cursor-pointer select-none truncate">{{ folder.name }}</span>
    </li>
</template>

<style scoped>
.selected {
    position: relative;
    z-index: 0;

    ::after {
        content: '';
        position: absolute;
        display: block;
        width: 3840px;
        height: 25px;
        left: -1920px;
        top: 0;
        background: #E0E7FF;
        z-index: -1;
    }
}
</style>
