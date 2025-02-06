<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const router = useRouter(); // Vue Router instance

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

// Define form state
const form = ref({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
    errors: {},
    processing: false,
});

// Submit function
const submit = async () => {
    form.value.processing = true;
    form.value.errors = {}; // Clear previous errors

    try {
        const response = await fetch('/reset-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                token: form.value.token,
                email: form.value.email,
                password: form.value.password,
                password_confirmation: form.value.password_confirmation,
            }),
        });

        const data = await response.json();

        if (!response.ok) {
            form.value.errors = data.errors || {};
        } else {
            // Redirect to login page after successful reset
            router.push('/login');
        }
    } catch (error) {
        console.error('Error:', error);
    } finally {
        form.value.processing = false;
    }
};
</script>

<template>
    <GuestLayout>
        <h1 class="text-xl font-bold text-center">Reset Password</h1>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
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
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reset Password
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
