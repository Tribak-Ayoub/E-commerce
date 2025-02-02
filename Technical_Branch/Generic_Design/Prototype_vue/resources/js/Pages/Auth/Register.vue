<script setup>
import { ref } from 'vue';
import axios from 'axios';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useRouter } from 'vue-router';

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const errors = ref({});
const processing = ref(false);
const router = useRouter();

const submit = async () => {
    processing.value = true;
    errors.value = {}; // Clear previous errors

    try {
        const response = await axios.post('/register', {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        });

        // Redirect to dashboard or another page after successful registration
        router.push('/dashboard');
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors; // Store validation errors
        } else {
            console.error('Registration failed:', error);
        }
    } finally {
        processing.value = false;
        password.value = ''; // Reset password fields
        password_confirmation.value = '';
    }
};
</script>

<template>
    <GuestLayout>
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="errors.name ? errors.name[0] : ''" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="errors.email ? errors.email[0] : ''" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="errors.password ? errors.password[0] : ''" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="errors.password_confirmation ? errors.password_confirmation[0] : ''" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <router-link
                    to="/login"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </router-link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': processing }"
                    :disabled="processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
