<template>
    <Head title="Welcome" />
    <div class="bg-gray-100 text-black/50 dark:bg-gray-900 dark:text-white/50">
        <div class="fixed mx-2 text-sm">
            <small>v{{ appVersion }}</small>
        </div>

        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-indigo-500 selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="min-w-[460px] grid grid-cols-2 items-center gap-2 py-2 lg:grid-cols-3 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <h1 class="flex flex-row items-center lg:justify-center lg:col-start-2">
                        <Link :href="'/'" class="inline-block w-12 h-12 shrink-0 m-2 text-indigo-500 dark:text-indigo-600">
                            <LogoIcon />
                        </Link>
                        <span class="inline-block text-gray-700 dark:text-white text-xl lg:text-3xl font-black">
                            {{ appName }}
                        </span>
                    </h1>

                    <nav v-if="canLogin" class="-mx-1 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-indigo-500 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-indigo-500 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-indigo-500 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="min-h-96 mt-6 text-black dark:text-white/70 text-center flex flex-col justify-center">
                    <p>
                        This is a
                        <span class="text-indigo-500 dark:text-indigo-600 font-medium">virtual file system</span>,
                        written in and for educational and demonstrational purposes.
                    </p>
                </main>

                <footer class="py-16 text-sm text-center">
                    <small>&copy; {{ new Date().getFullYear() }} {{ appName }} All rights reserved | Laravel v{{ laravelVersion }} | PHP v{{ phpVersion }}</small>
                </footer>
            </div>
        </div>
    </div>
</template>

<script setup>
import LogoIcon from '@/Components/Icons/LogoIcon.vue';
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

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
}
</script>
