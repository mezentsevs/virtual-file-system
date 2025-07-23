<template>
    <li :id="`file-${file.id}`" class="file flex flex-row items-center">
        <div
            class="inline-block w-6 h-6 shrink-0 fill-gray-800 dark:fill-gray-200 hover:fill-indigo-600 dark:hover:fill-indigo-400 cursor-pointer transition-[fill]"
            @click="onFileClick"
        >
            <FileIcon />
        </div>

        <span
            class="inline-block ml-1 hover:text-indigo-600 dark:hover:text-indigo-400 truncate cursor-pointer select-none transition-colors"
            @click="onFileClick"
        >
            {{ file.name }}
        </span>
    </li>
</template>

<script setup>
import FileIcon from '@/Components/Icons/FileIcon.vue';

const props = defineProps({
    file: {
        type: Object,
        default: {},
    },
});

const emit = defineEmits(['itemSelected']);

const onFileClick = event => {
    setSelected(event.target.closest('.file'));

    emit('itemSelected', props.file);
};

const setSelected = $file => {
    if (!$file.classList.value.includes('selected')) {
        document.querySelectorAll('.folder')
            .forEach((folder) => folder.classList.remove('selected'));

        document.querySelectorAll('.file')
            .forEach((file) => file.classList.remove('selected'));

        $file.classList.add('selected');
    }
};
</script>
