<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

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

const email = ref(props.email);
const token = ref(props.token);
const password = ref('');
const password_confirmation = ref('');
const errors = ref({});
const processing = ref(false);
const router = useRouter();

const submit = async () => {
    processing.value = true;
    errors.value = {}; // Reset errors

    try {
        const response = await axios.post('/password/reset', {
            email: email.value,
            token: token.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        });

        // Redirect to login page after successful reset
        router.push('/login');
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors; // Capture validation errors
        } else {
            console.error('Password reset failed:', error);
        }
    } finally {
        processing.value = false;
    }
};
</script>

<template>
    <GuestLayout>
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
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="errors.password ? errors.password[0] : ''" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

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
                <PrimaryButton
                    :class="{ 'opacity-25': processing }"
                    :disabled="processing"
                >
                    Reset Password
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
