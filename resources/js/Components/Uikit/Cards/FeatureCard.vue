<template>
    <div
        class="group h-full p-6 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
        :style="{ animationDelay: `${delay}ms` }"
        :class="[
            'animate-fade-in-up',
            color === 'indigo'
                ? 'hover:border-indigo-300 dark:hover:border-indigo-500'
                : color === 'purple'
                  ? 'hover:border-purple-300 dark:hover:border-purple-500'
                  : color === 'blue'
                    ? 'hover:border-blue-300 dark:hover:border-blue-500'
                    : 'hover:border-pink-300 dark:hover:border-pink-500',
        ]">
        <!-- Icon with background -->
        <div class="mb-4">
            <div
                class="inline-flex p-3 rounded-lg mb-4 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300"
                :class="[
                    color === 'indigo'
                        ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400'
                        : color === 'purple'
                          ? 'bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400'
                          : color === 'blue'
                            ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400'
                            : 'bg-pink-50 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400',
                ]">
                <!-- SVG Icon component -->
                <component :is="feature.iconComponent" class="w-6 h-6" />
            </div>
        </div>

        <!-- Content -->
        <div>
            <h3
                class="text-xl font-semibold mb-3 group-hover:translate-x-1 transition-transform duration-300"
                :class="[
                    color === 'indigo'
                        ? 'text-indigo-700 dark:text-indigo-300'
                        : color === 'purple'
                          ? 'text-purple-700 dark:text-purple-300'
                          : color === 'blue'
                            ? 'text-blue-700 dark:text-blue-300'
                            : 'text-pink-700 dark:text-pink-300',
                ]">
                {{ feature.title }}
            </h3>

            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ feature.description }}
            </p>
        </div>

        <!-- Decorative bottom accent -->
        <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700">
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <div
                    class="w-full h-1 rounded-full"
                    :class="[
                        color === 'indigo'
                            ? 'bg-gradient-to-r from-indigo-400 to-transparent'
                            : color === 'purple'
                              ? 'bg-gradient-to-r from-purple-400 to-transparent'
                              : color === 'blue'
                                ? 'bg-gradient-to-r from-blue-400 to-transparent'
                                : 'bg-gradient-to-r from-pink-400 to-transparent',
                    ]" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
    feature: {
        type: Object,
        required: true,
    },
    color: {
        type: String,
        default: 'indigo',
    },
    delay: {
        type: Number,
        default: 0,
    },
});
</script>
