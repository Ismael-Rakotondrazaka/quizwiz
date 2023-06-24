<template>
    <AuthenticatedLayout>

        <Head title="Edit a question" />

        <TheEditQuestionForm :question="question" class="" />
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TheEditQuestionForm from "@/Components/Questions/TheEditQuestionForm.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});
</script>

<style scoped></style>
