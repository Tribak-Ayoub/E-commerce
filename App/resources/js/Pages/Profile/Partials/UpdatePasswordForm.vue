<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, reactive } from 'vue';
import { useRouter } from 'vue-router';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = reactive({
    current_password: '',
    password: '',
    password_confirmation: '',
    errors: {},
    processing: false,
    recentlySuccessful: false,
});

const router = useRouter();

const updatePassword = async () => {
    form.processing = true;
    form.errors = {}; // Reset errors

    try {
        const response = await fetch(route('password.update'), {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                current_password: form.current_password,
                password: form.password,
                password_confirmation: form.password_confirmation,
            }),
        });

        if (!response.ok) {
            const data = await response.json();
            form.errors = data.errors || {};
            if (form.errors.password) {
                form.password = '';
                form.password_confirmation = '';
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.current_password = '';
                currentPasswordInput.value.focus();
            }
            return;
        }

        // On success
        form.recentlySuccessful = true;
        form.current_password = '';
        form.password = '';
        form.password_confirmation = '';
        setTimeout(() => form.recentlySuccessful = false, 3000);
    } catch (error) {
        console.error('An error occurred:', error);
    } finally {
        form.processing = false;
    }
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Update Password
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay
                secure.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div>
                <InputLabel for="current_password" value="Current Password" />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="current-password"
                />

                <InputError
                    :message="form.errors.current_password"
                    class="mt-2"
                />
            </div>

            <div>
                <InputLabel for="password" value="New Password" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div>
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />

                <InputError
                    :message="form.errors.password_confirmation"
                    class="mt-2"
                />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
