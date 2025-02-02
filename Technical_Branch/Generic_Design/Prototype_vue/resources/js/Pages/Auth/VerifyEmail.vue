<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    status: {
        type: String,
    },
});

const processing = ref(false);
const router = useRouter();

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);

const submit = async () => {
    processing.value = true;
    try {
        await axios.post('/email/verification-notification');
        // Optionally, set a status message indicating the email was resent
    } catch (error) {
        console.error('Error resending verification email:', error);
    } finally {
        processing.value = false;
    }
};
</script>

<template>
    <GuestLayout>
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
                    :class="{ 'opacity-25': processing.value }"
                    :disabled="processing.value"
                >
                    Resend Verification Email
                </PrimaryButton>

                <router-link
                    to="/logout"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Log Out
                </router-link>
            </div>
        </form>
    </GuestLayout>
</template>
