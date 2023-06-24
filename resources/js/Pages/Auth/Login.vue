<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import TheLoginForm from '@/Components/Auth/TheLoginForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <GuestLayout>

        <Head title="Sign in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <TheLoginForm :canResetPassword="canResetPassword" :status="status" />
    </GuestLayout>
</template>
