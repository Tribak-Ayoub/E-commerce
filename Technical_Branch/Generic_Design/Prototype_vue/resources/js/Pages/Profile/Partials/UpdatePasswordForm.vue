<script setup>
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import axios from 'axios';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = ref({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const errors = ref({});

const updatePassword = async () => {
    try {
        await axios.put('/password/update', form.value, {
            // Optionally, you can handle session preservation if necessary
        });
        // Reset form on success
        form.value.current_password = '';
        form.value.password = '';
        form.value.password_confirmation = '';
        errors.value = {};
    } catch (error) {
        // Handle validation errors
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
        }
        if (errors.value.password) {
            form.value.password = '';
            form.value.password_confirmation = '';
            passwordInput.value.focus();
        }
        if (errors.value.current_password) {
            form.value.current_password = '';
            currentPasswordInput.value.focus();
        }
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
                    :message="errors.value.current_password"
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

                <InputError :message="errors.value.password" class="mt-2" />
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
                    :message="errors.value.password_confirmation"
                    class="mt-2"
                />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="!form.value.password || !form.value.password_confirmation || !form.value.current_password">
                    Save
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="!Object.keys(errors.value).length"
                        class="text-sm text-gray-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
