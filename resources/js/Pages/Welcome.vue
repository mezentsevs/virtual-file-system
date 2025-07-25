<template>
    <Head title="Welcome" />
    <div class="bg-gray-100 text-black/50 dark:bg-gray-900 dark:text-white/50">
        <div class="fixed mx-2 text-sm">
            <small>v{{ appVersion }}</small>
        </div>

        <div
            class="relative min-h-screen px-0 sm:px-4 pt-8 sm:pt-0 selection:bg-indigo-500 selection:text-white flex flex-col items-center justify-start sm:justify-center"
        >
            <div class="relative w-full max-w-2xl lg:max-w-7xl min-w-[20rem]">
                <header
                    class="w-full min-w-min py-4 bg-white dark:bg-gray-800 grid grid-cols-1 sm:grid-cols-3 items-center gap-2 sm:gap-4 rounded-none sm:rounded-2xl shadow-md"
                >
                    <h1
                        class="flex flex-row items-center justify-center sm:col-start-2 sm:justify-center"
                    >
                        <Link
                            :href="'/'"
                            class="inline-block w-8 h-8 sm:w-12 sm:h-12 shrink-0 m-1 sm:m-2 text-indigo-500 dark:text-indigo-600"
                        >
                            <LogoIcon />
                        </Link>
                        <span
                            class="inline-block text-gray-700 dark:text-white text-lg sm:text-xl lg:text-3xl font-black tracking-tight whitespace-nowrap"
                        >
                            {{ appName }}
                        </span>
                    </h1>

                    <nav
                        v-if="canLogin"
                        class="px-2 flex justify-center sm:justify-end sm:col-start-3"
                    >
                        <div class="flex flex-wrap justify-center gap-1 sm:gap-0">
                            <NavButton v-if="$page.props.auth.user" :href="route('dashboard')">
                                Dashboard
                            </NavButton>

                            <template v-else>
                                <NavButton :href="route('login')"> Log in </NavButton>

                                <NavButton v-if="canRegister" :href="route('register')">
                                    Register
                                </NavButton>
                            </template>
                        </div>
                    </nav>
                </header>

                <main
                    class="min-w-min min-h-96 mt-1 sm:mt-10 px-0 sm:px-8 py-6 sm:py-10 bg-white dark:bg-gray-800 text-black dark:text-white/70 text-center flex flex-col justify-center rounded-none sm:rounded-2xl shadow-md"
                >
                    <p class="max-w-2xl mx-auto text-base sm:text-lg leading-relaxed">
                        This is a
                        <span class="text-indigo-500 dark:text-indigo-400 font-medium"
                            >virtual file system</span
                        >, written in and for educational and demonstrational purposes.
                    </p>
                </main>

                <footer class="py-8 sm:py-16 text-xs sm:text-sm text-center">
                    <small
                        >&copy; {{ new Date().getFullYear() }} {{ appName }} All rights reserved |
                        Laravel v{{ laravelVersion }} | PHP v{{ phpVersion }}</small
                    >
                </footer>
            </div>
        </div>
    </div>
</template>

<script setup>
import LogoIcon from '@/Components/Icons/LogoIcon.vue';
import NavButton from '@/Components/Uikit/Buttons/NavButton.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    appName: {
        type: String,
        required: true,
    },
    appVersion: {
        type: String,
        required: true,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>
