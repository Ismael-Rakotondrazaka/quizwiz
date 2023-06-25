<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import TheEditAnswerForm from "@/Components/Answers/TheEditAnswerForm.vue";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
    answer: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Edit an answer" />

        <TheEditAnswerForm :question="props.question" :answer="props.answer" />
    </AuthenticatedLayout>
</template>
