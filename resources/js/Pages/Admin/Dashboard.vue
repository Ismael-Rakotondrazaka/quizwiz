<template>
    <AuthenticatedLayout>
        <Head title="Admin | Dashboard" />

        <TheAdminDashboard
            :user-count="userCount"
            :question-count="questionCount"
            :session-count="sessionCount"
            class="my-10"
        />
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TheAdminDashboard from "@/Components/Admin/TheAdminDashboard.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    userCount: {
        type: Number,
        required: false,
        default: 0,
    },
    questionCount: {
        type: Number,
        required: false,
        default: 0,
    },
    sessionCount: {
        type: Number,
        required: false,
        default: 0,
    },
});
</script>

<style scoped></style>
