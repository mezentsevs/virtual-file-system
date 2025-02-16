<script setup>
import FileIcon from '@/Icons/FileIcon.vue';

const props = defineProps({
    file: {
        type: Object,
        default: {},
    },
});

const emit = defineEmits(['itemSelected']);

function onFileClick(event) {
    setSelected(event.target.closest('.file'));

    emit('itemSelected', props.file);
}

function setSelected($file) {
    if (!$file.classList.value.includes('selected')) {
        document.querySelectorAll('.folder')
            .forEach((folder) => folder.classList.remove('selected'));

        document.querySelectorAll('.file')
            .forEach((file) => file.classList.remove('selected'));

        $file.classList.add('selected');
    }
}
</script>

<template>
    <li :id="`file-${file.id}`" class="file flex flex-row items-center">
        <div
            class="inline-block w-[25px] h-[25px] shrink-0 cursor-pointer fill-gray-500 dark:fill-gray-400 hover:fill-indigo-600 transition-[fill]"
            @click="onFileClick"
        >
            <FileIcon />
        </div>

        <span
            class="inline-block ml-[5px] cursor-pointer select-none truncate hover:text-indigo-600 transition-colors"
            @click="onFileClick"
        >
            {{ file.name }}
        </span>
    </li>
</template>

<style scoped>
.selected {
    color: #1F2937;
    font-weight: bold;
    position: relative;
    z-index: 0;

    svg {
        fill: #1F2937;
        transition: fill 0.15s cubic-bezier(0.4, 0, 0.2, 1);

        &:hover {
            fill: #4F46E5;
        }
    }

    &:after {
        content: '';
        position: absolute;
        display: block;
        width: 3840px;
        height: 25px;
        left: -1920px;
        top: 0;
        background: #E0E7FF;
        z-index: -1;
        animation: appearance 0.25s ease-in-out, bounce 0.25s ease-in-out;
    }
}

@keyframes appearance {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

@keyframes bounce {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.1);
    }

    100% {
        transform: scale(1);
    }
}
</style>
