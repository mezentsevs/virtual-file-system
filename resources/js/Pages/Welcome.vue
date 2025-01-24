<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

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

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-gray-900 dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#818DF8] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="min-w-[460px] grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <h1 class="flex flex-row items-center">
                            <Link :href="'/'" class="inline-block w-[70px] h-[70px] shrink-0">
                                <ApplicationLogo class="p-[10px]" />
                            </Link>
                            <span class="inline-block text-xl lg:text-3xl font-black text-gray-700 dark:text-gray-200">{{ appName }}</span>
                        </h1>
                    </div>

                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#818DF8] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#818DF8] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#818DF8] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="min-h-96 mt-6 text-center text-black dark:text-white/70 flex flex-col justify-center">
                    <p>
                        This is a
                        <span class="font-medium text-[#818DF8]">virtual</span>
                        file system written in and for educational purposes.
                    </p>
                </main>

                <footer class="py-16 text-center text-sm">
                    <small>&copy; {{ new Date().getFullYear() }} {{ appName }} All rights reserved | Laravel v{{ laravelVersion }} | PHP v{{ phpVersion }}</small>
                </footer>
            </div>
        </div>
    </div>
</template>
