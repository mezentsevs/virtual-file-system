<template>
    <textarea
        ref="area"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)" />
</template>

<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const area = ref(null);

onMounted(() => {
    if (area.value.hasAttribute('autofocus')) {
        area.value.focus();
    }
});

defineExpose({ focus: () => area.value.focus() });
</script>
