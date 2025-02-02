<script setup>
import { ref } from 'vue';
import axios from 'axios';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const email = ref('');
const status = ref('');
const errors = ref({});

const submit = async () => {
    try {
        const response = await axios.post('/password/email', { email: email.value });

        status.value = response.data.message; // Success message
        errors.value = {}; // Clear errors
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors; // Validation errors
        } else {
            console.error('Request failed:', error);
        }
    }
};
</script>

<template>
    <GuestLayout>
        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just enter your email address,
            and we'll send you a password reset link.
        </div>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="errors.email ? errors.email[0] : ''" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <PrimaryButton> Email Password Reset Link </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
