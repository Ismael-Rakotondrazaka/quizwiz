<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TheCreateAnswerForm from "@/Components/Answers/TheCreateAnswerForm.vue";
import { Head, } from "@inertiajs/vue3";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Create an answer" />

        <TheCreateAnswerForm :question="question" />
    </AuthenticatedLayout>
</template>
