<template>
    <li :id="`folder-${folder.id}`" class="folder flex flex-row items-center">
        <div
            class="inline-block w-6 h-6 shrink-0 fill-gray-500 dark:fill-gray-400 hover:fill-indigo-600 cursor-pointer transition-[fill]"
            @click="onFolderIconClick"
        >
            <component :is="icons[currentIcon]" />
        </div>

        <span
            class="inline-block ml-1 hover:text-indigo-600 truncate cursor-pointer select-none transition-colors"
            @click="onFolderNameClick"
        >
            {{ folder.name }}
        </span>
    </li>
</template>

<script setup>
import FolderIcon from '@/Components/Icons/FolderIcon.vue';
import FolderOpenIcon from '@/Components/Icons/FolderOpenIcon.vue';
import { ref } from 'vue';

const props = defineProps({
    folder: {
        type: Object,
        default: {},
    },
});

const emit = defineEmits([
    'itemSelected',
    'iconToggled',
]);

const currentIcon = ref('closed');

const icons = {
    closed: FolderIcon,
    opened: FolderOpenIcon,
};

function onFolderIconClick() {
    toggleIcon();

    emit('iconToggled', currentIcon.value);
}

function onFolderNameClick(event) {
    setSelected(event.target.closest('.folder'));

    emit('itemSelected', props.folder);
}

function toggleIcon() {
    currentIcon.value = currentIcon.value === 'closed' ? 'opened' : 'closed';
}

function setSelected($folder) {
    if (!$folder.classList.value.includes('selected')) {
        document.querySelectorAll('.folder')
            .forEach((folder) => folder.classList.remove('selected'));

        document.querySelectorAll('.file')
            .forEach((file) => file.classList.remove('selected'));

        $folder.classList.add('selected');
    }
}
</script>
