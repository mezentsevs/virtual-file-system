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

const BACKGROUND_COLOR_CLASS = 'bg-indigo-100';

function onFolderClick(event) {
    toggleIcon();

    const $folder = event.target.closest('.folder');

    toggleChildrenFolders($folder);

    setBackgroundColor($folder, BACKGROUND_COLOR_CLASS);

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

function setBackgroundColor($folder, backgroundColorClass) {
    if (!$folder.classList.value.includes(backgroundColorClass)) {
        document.querySelectorAll('.folder')
            .forEach((folder) => folder.classList.remove(backgroundColorClass));

        $folder.classList.add(backgroundColorClass);
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
