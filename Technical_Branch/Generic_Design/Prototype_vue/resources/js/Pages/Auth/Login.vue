<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useRoute, useRouter } from 'vue-router';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const email = ref('');
const password = ref('');
const remember = ref(false);
const errors = ref({});
const processing = ref(false);
const router = useRouter();

const submit = async () => {
    processing.value = true;
    errors.value = {}; // Clear previous errors

    try {
        const response = await axios.post('/login', {
            email: email.value,
            password: password.value,
            remember: remember.value,
        });

        // Redirect to dashboard or home page after login
        router.push('/dashboard');
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors; // Store validation errors
        } else {
            console.error('Login failed:', error);
        }
    } finally {
        processing.value = false;
        password.value = ''; // Reset password field
    }
};
</script>

<template>
    <GuestLayout>
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

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="errors.password ? errors.password[0] : ''" />
            </div>

            <div class="mt-4 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <router-link
                    v-if="canResetPassword"
                    to="/password/reset"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </router-link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': processing }"
                    :disabled="processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
