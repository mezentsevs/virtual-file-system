<template>
    <li :id="`folder-${folder.id}`" class="folder flex flex-row items-center">
        <div
            class="inline-block w-6 h-6 shrink-0 fill-gray-800 dark:fill-gray-200 hover:fill-indigo-600 dark:hover:fill-indigo-400 cursor-pointer transition-[fill]"
            @click="onFolderIconClick"
        >
            <component :is="icons[currentIcon]" />
        </div>

        <span
            class="inline-block ml-1 hover:text-indigo-600 dark:hover:text-indigo-400 truncate cursor-pointer select-none transition-colors"
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
import { useClearSelection } from '@/Composables/SelectionComposables.js';

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

const { clearSelection } = useClearSelection();

const currentIcon = ref('closed');

const icons = {
    closed: FolderIcon,
    opened: FolderOpenIcon,
};

const onFolderIconClick = () => {
    toggleIcon();

    emit('iconToggled', currentIcon.value);
};

const onFolderNameClick = event => {
    setSelected(event.target.closest('.folder'));

    emit('itemSelected', props.folder);
};

const toggleIcon = () => currentIcon.value = currentIcon.value === 'closed' ? 'opened' : 'closed';

const setSelected = $folder => {
    if ($folder.classList.value.includes('selected')) { return; }

    clearSelection();

    $folder.classList.add('selected');
};
</script>
