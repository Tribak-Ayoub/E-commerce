<script setup>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const router = useRouter(); // Vue Router instance

const props = defineProps({
    status: {
        type: String,
    },
});

// Define form state
const form = ref({
    processing: false,
    errors: {},
});

// Check if verification link was sent
const verificationLinkSent = computed(() => props.status === 'verification-link-sent');

// Function to resend verification email
const submit = async () => {
    form.value.processing = true;
    form.value.errors = {};

    try {
        const response = await fetch('/email/verification-notification', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        if (!response.ok) {
            const data = await response.json();
            form.value.errors = data.errors || {};
        }
    } catch (error) {
        console.error('Error:', error);
    } finally {
        form.value.processing = false;
    }
};

// Function to log out
const logout = async () => {
    try {
        await fetch('/logout', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });
        router.push('/login'); // Redirect to login page after logout
    } catch (error) {
        console.error('Logout Error:', error);
    }
};
</script>

<template>
    <GuestLayout>
        <h1 class="text-xl font-bold text-center">Email Verification</h1>

        <div class="mb-4 text-sm text-gray-600">
            Thanks for signing up! Before getting started, could you verify your
            email address by clicking on the link we just emailed to you? If you
            didn't receive the email, we will gladly send you another.
        </div>

        <div
            class="mb-4 text-sm font-medium text-green-600"
            v-if="verificationLinkSent"
        >
            A new verification link has been sent to the email address you
            provided during registration.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Resend Verification Email
                </PrimaryButton>

                <button
                    @click="logout"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Log Out
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
