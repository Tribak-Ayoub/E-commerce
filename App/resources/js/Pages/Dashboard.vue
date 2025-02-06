<script setup>
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const router = useRouter();

// Check if user is authenticated (optional)
onMounted(async () => {
    try {
        const response = await fetch('/api/user', {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        if (!response.ok) {
            router.push('/login'); // Redirect if not authenticated
        }
    } catch (error) {
        console.error('Authentication Check Failed:', error);
        router.push('/login');
    }
});

// Logout function
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
        console.error('Logout Failed:', error);
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        You're logged in!
                        <button
                            @click="logout"
                            class="ml-4 px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700"
                        >
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
