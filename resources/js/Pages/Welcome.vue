<template>
    <Head title="Welcome" />
    <div
        class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-950 transition-colors duration-300">
        <!-- Top Bar -->
        <div
            class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Left side - Logo and version -->
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 text-indigo-500 dark:text-indigo-600">
                            <LogoIcon />
                        </div>

                        <div class="flex items-center space-x-2">
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ appName }}
                            </span>
                            <span
                                class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded text-xs text-gray-600 dark:text-gray-400">
                                v{{ appVersion }}
                            </span>
                        </div>
                    </div>

                    <!-- Right side - Theme toggle and auth buttons -->
                    <div class="flex items-center space-x-4">
                        <ThemeToggle />

                        <div class="hidden sm:flex items-center space-x-3">
                            <div v-if="canLogin" class="flex items-center space-x-2">
                                <AuthLink v-if="$page.props.auth.user" :href="route('dashboard')">
                                    Dashboard
                                </AuthLink>
                                <template v-else>
                                    <AuthLink :href="route('login')">Log in</AuthLink>
                                    <AuthLink v-if="canRegister" :href="route('register')">
                                        Register
                                    </AuthLink>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="pt-24 pb-32 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <!-- Hero Section -->
            <div class="text-center mb-16 animate-fade-in-up">
                <div
                    class="inline-block mb-6 p-3 rounded-2xl bg-gradient-to-br from-indigo-500/10 via-purple-500/10 to-pink-500/10">
                    <div
                        class="w-16 h-16 sm:w-20 sm:h-20 text-indigo-500 dark:text-indigo-600 mx-auto">
                        <LogoIcon />
                    </div>
                </div>

                <h1
                    class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                    <span
                        class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 bg-clip-text text-transparent">
                        Virtual File System
                    </span>
                </h1>

                <p
                    class="text-xl sm:text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    A modern, interactive file management system. Experience seamless file
                    organization with real-time editing, full CRUD functionality, and an intuitive
                    user interface.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="mb-20">
                <h2
                    class="text-3xl sm:text-4xl font-bold text-center text-gray-900 dark:text-white mb-12">
                    Key Features
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <FeatureCard
                        v-for="(feature, index) in features"
                        :key="feature.title"
                        :feature="feature"
                        :color="getColor(index)"
                        :delay="index * 100" />
                </div>
            </div>

            <!-- CTA Section -->
            <div
                v-if="!$page.props.auth.user && (canLogin || canRegister)"
                class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-8 sm:p-12 text-white mb-16">
                <div class="relative z-10 max-w-3xl mx-auto text-center">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4">
                        Start Organizing Your Virtual Files Today
                    </h3>

                    <p class="text-indigo-100 mb-8">
                        Experience the power of modern file management with our intuitive interface
                        and robust features. Perfect for educational purposes and real-world
                        applications.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link
                            v-if="canLogin"
                            :href="route('login')"
                            class="px-6 py-2.5 bg-white text-indigo-600 hover:bg-gray-100 active:bg-gray-200 rounded-lg font-semibold transition-colors duration-200 text-sm active:scale-95 flex items-center justify-center">
                            Get Started
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="px-6 py-2.5 bg-transparent border-2 border-white hover:bg-white/10 active:bg-white/20 rounded-lg font-semibold transition-colors duration-200 text-sm active:scale-95 flex items-center justify-center">
                            Create Account
                        </Link>
                    </div>
                </div>

                <!-- Background elements -->
                <div
                    class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2 animate-subtle-float" />
                <div
                    class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/3 translate-y-1/3 animate-subtle-float" />
            </div>

            <!-- Tech Stack -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-10">
                    Built With
                </h2>

                <div
                    class="flex flex-wrap justify-center items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                    <div
                        class="flex items-center space-x-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-lg">
                        <span class="font-medium text-violet-600 dark:text-violet-400">PHP</span>
                        <span class="text-gray-400 dark:text-gray-500">v{{ phpVersion }}</span>
                    </div>
                    <div
                        class="flex items-center space-x-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-lg">
                        <span class="font-medium text-red-600 dark:text-red-400">Laravel</span>
                        <span class="text-gray-400 dark:text-gray-500">v{{ laravelVersion }}</span>
                    </div>
                    <div
                        class="flex items-center space-x-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-lg">
                        <span class="font-medium text-emerald-500 dark:text-emerald-400">
                            Vue.js
                        </span>
                        <span class="text-gray-400 dark:text-gray-500">Composition API</span>
                    </div>
                    <div
                        class="flex items-center space-x-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-lg">
                        <span class="font-medium text-purple-600 dark:text-purple-400">
                            Inertia.js
                        </span>
                        <span class="text-gray-400 dark:text-gray-500">SPA Experience</span>
                    </div>
                </div>
            </div>

            <!-- Mobile auth buttons (inside main flow) -->
            <div v-if="canLogin" class="sm:hidden mb-12">
                <div class="flex flex-col space-y-3">
                    <AuthLink
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        variant="mobile">
                        Dashboard
                    </AuthLink>
                    <template v-else>
                        <AuthLink :href="route('login')" variant="mobile">Log in</AuthLink>
                        <AuthLink v-if="canRegister" :href="route('register')" variant="mobile">
                            Register
                        </AuthLink>
                    </template>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer
            class="py-12 border-t border-gray-200/50 dark:border-gray-700/50 bg-white/50 dark:bg-gray-900/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Left: Logo and app name -->
                    <div class="flex flex-col items-center md:items-start">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 text-indigo-500 dark:text-indigo-600">
                                <LogoIcon />
                            </div>

                            <div class="flex flex-col">
                                <span class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ appName }}
                                </span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    v{{ appVersion }}
                                </span>
                            </div>
                        </div>

                        <p
                            class="text-gray-600 dark:text-gray-400 text-sm text-center md:text-left">
                            A modern file management solution for organizing virtual files with
                            ease.
                        </p>
                    </div>

                    <!-- Center: Links -->
                    <div class="flex flex-col items-center md:items-start">
                        <h4 class="text-gray-900 dark:text-white font-semibold mb-4">
                            Quick Links
                        </h4>

                        <div class="flex flex-col space-y-2 items-center md:items-start">
                            <Link
                                v-for="link in quickLinks"
                                :key="link.label"
                                :href="route(link.routeName)"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 text-sm">
                                {{ link.label }}
                            </Link>
                        </div>
                    </div>

                    <!-- Right: Copyright -->
                    <div class="flex flex-col items-center md:items-end text-center md:text-right">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            &copy; {{ new Date().getFullYear() }} {{ appName }} | All rights
                            reserved
                        </p>

                        <p class="text-gray-500 dark:text-gray-500 text-xs mt-2">
                            Start Organizing Your Virtual Files.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthLink from '@/Components/Uikit/Links/AuthLink.vue';
import FeatureCard from '@/Components/Uikit/Cards/FeatureCard.vue';
import FileEditIcon from '@/Components/Icons/FileEditIcon.vue';
import FolderTreeIcon from '@/Components/Icons/FolderTreeIcon.vue';
import LogoIcon from '@/Components/Icons/LogoIcon.vue';
import StorageIcon from '@/Components/Icons/StorageIcon.vue';
import ThemeLightIcon from '@/Components/Icons/ThemeLightIcon.vue';
import ThemeToggle from '@/Components/Uikit/Toggles/ThemeToggle.vue';

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

const features = [
    {
        icon: 'FolderTree',
        iconComponent: FolderTreeIcon,
        title: 'File Tree Browser',
        description: 'Navigate nested folders and files with an intuitive tree view interface.',
    },
    {
        icon: 'FileEdit',
        iconComponent: FileEditIcon,
        title: 'Live File Editor',
        description: 'Edit file contents directly in browser with instant save functionality.',
    },
    {
        icon: 'Storage',
        iconComponent: StorageIcon,
        title: 'Storage Manager',
        description: 'Virtual file system with automatic size calculations and metadata tracking.',
    },
    {
        icon: 'ThemeLight',
        iconComponent: ThemeLightIcon,
        title: 'Theme Toggle',
        description: 'Switch between light and dark themes with persistent user preferences.',
    },
];

const quickLinks = [
    { label: 'Home', routeName: 'welcome' },
    { label: 'Features', routeName: 'welcome' },
    { label: 'Documentation', routeName: 'welcome' },
    { label: 'Support', routeName: 'welcome' },
];

const colorOrder = ['indigo', 'purple', 'blue', 'pink'];

const getColor = index => colorOrder[index] || 'indigo';
</script>

<style>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes subtle-float {
    0%,
    100% {
        transform: translate(0, 0);
    }
    25% {
        transform: translate(5px, -4px);
    }
    50% {
        transform: translate(-4px, 5px);
    }
    75% {
        transform: translate(3px, 3px);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out;
}

.animate-subtle-float {
    animation: subtle-float 25s ease-in-out infinite;
}
</style>
