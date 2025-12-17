<template>
    <li :id="`file-${file.id}`" class="file flex flex-row items-center">
        <div
            class="inline-block w-6 h-6 shrink-0 fill-gray-800 dark:fill-gray-200 hover:fill-indigo-600 dark:hover:fill-indigo-400 cursor-pointer transition-[fill]"
            @click="onFileClick">
            <FileIcon />
        </div>

        <span
            :title="file.name"
            class="inline-block ml-1 hover:text-indigo-600 dark:hover:text-indigo-400 truncate cursor-pointer select-none transition-colors"
            @click="onFileClick">
            {{ file.name }}
        </span>
    </li>
</template>

<script setup>
import FileIcon from '@/Components/Icons/FileIcon.vue';
import { useSelection } from '@/Composables/SelectionComposable.js';

const props = defineProps({
    file: {
        type: Object,
        default: {},
    },
});

const emit = defineEmits(['itemSelected']);

const { setSelected } = useSelection();

const onFileClick = event => {
    setSelected(event.target.closest('.file'));

    emit('itemSelected', props.file);
};
</script>
