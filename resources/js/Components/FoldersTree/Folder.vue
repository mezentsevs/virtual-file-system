<script setup>
import FolderIcon from '@/Icons/FolderIcon.vue';
import FolderOpenIcon from '@/Icons/FolderOpenIcon.vue';
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

<template>
    <li :id="`folder-${folder.id}`" class="folder flex flex-row items-center">
        <div
            class="inline-block w-[25px] h-[25px] shrink-0 cursor-pointer fill-gray-500 dark:fill-gray-400 hover:fill-indigo-600 transition-[fill]"
            @click="onFolderIconClick"
        >
            <Transition name="icon" mode="out-in">
                <component :is="icons[currentIcon]" />
            </Transition>
        </div>

        <span
            class="inline-block ml-[5px] cursor-pointer select-none truncate hover:text-indigo-600 transition-colors"
            @click="onFolderNameClick"
        >
            {{ folder.name }}
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
        animation: appearance 0.25s ease-in-out, bounce 0.25s ease-in-out;
        background: #E0E7FF;
        content: '';
        display: block;
        height: 25px;
        left: -1920px;
        position: absolute;
        top: 0;
        width: 3840px;
        z-index: -1;
    }
}

.icon-enter-active,
.icon-leave-active {
    animation: bounce 0.25s ease-in-out;
    transition: opacity 0.25s ease-in-out;
}

.icon-enter-from,
.icon-leave-to {
    opacity: 0;
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
