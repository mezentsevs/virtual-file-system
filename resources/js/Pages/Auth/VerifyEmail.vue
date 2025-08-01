<template>
    <Head title="Email Verification" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Before continuing, could you verify your email address by clicking on the link we just
            emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <div
            v-if="verificationLinkSent"
            class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            A new verification link has been sent to the email address you provided in your profile
            settings.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Resend Verification Email
                </PrimaryButton>

                <div>
                    <Link
                        :href="route('profile.show')"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        Edit Profile
                    </Link>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ms-2">
                        Log Out
                    </Link>
                </div>
            </div>
        </form>
    </AuthenticationCard>
</template>

<script setup>
import AuthenticationCard from '@/Components/Auth/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/Auth/AuthenticationCardLogo.vue';
import PrimaryButton from '@/Components/Uikit/Buttons/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>
