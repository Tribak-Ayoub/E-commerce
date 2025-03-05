<script setup>
import { useAuthStore } from '@/stores/authStore';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const authStore = useAuthStore(); 

const form = ref({
    email: '',
    password: '',
    remember: false,
    errors: {}
});

const status = ref('');
const processing = ref(false);
const canResetPassword = ref(false);

const submit = async () => {
    console.log('Submit clicked');  // ✅ Debugging
    processing.value = true;
    try {
        console.log('Calling authStore.login()...');
        await authStore.login({
            email: form.value.email,
            password: form.value.password,
            remember: form.value.remember
        });

        const redirectTo = router.currentRoute.value.query.redirect || '/dashboard';
        console.log('Redirecting to:', redirectTo);  // ✅ Debugging
        router.push(redirectTo);
    } catch (error) {
        console.error('Login failed:', error);
        form.value.errors = error.response?.data.errors || {};
    } finally {
        processing.value = false;
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
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <RouterLink
                    v-if="canResetPassword"
                    :to="{ name: 'password.request' }"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </RouterLink>

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