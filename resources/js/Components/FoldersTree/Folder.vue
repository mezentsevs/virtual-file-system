<script setup>
import { getNextSiblingBySelector } from '@/Helpers/QueryHelper.js';
import FolderIcon from '@/Icons/FolderIcon.vue';
import FolderOpenIcon from '@/Icons/FolderOpenIcon.vue';
import { ref } from 'vue';

const currentIcon = ref('closed');

const icons = {
    closed: FolderIcon,
    opened: FolderOpenIcon,
};

function onFolderClick(event) {
    currentIcon.value = currentIcon.value === 'closed' ? 'opened' : 'closed';

    const $childrenFoldersElement = getNextSiblingBySelector(event.target.closest('.folder'), '.children-folders');

    if ($childrenFoldersElement) {
        $childrenFoldersElement.classList.toggle('hidden');
    }
}
</script>

<template>
    <li class="folder flex flex-row items-center" @click="onFolderClick">
        <div class="inline-block w-[25px] h-[25px] shrink-0 cursor-pointer fill-gray-500 dark:fill-gray-400 hover:fill-indigo-600">
            <component :is="icons[currentIcon]" />
        </div>
        <span class="inline-block ml-[5px] cursor-pointer select-none truncate"><slot /></span>
    </li>
</template>
