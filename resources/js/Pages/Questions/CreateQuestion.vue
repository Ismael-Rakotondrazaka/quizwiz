<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TheCreateQuestionForm from "@/Components/Questions/TheCreateQuestionForm.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Create question" />

        <TheCreateQuestionForm class="my-10" />
    </AuthenticatedLayout>
</template>
