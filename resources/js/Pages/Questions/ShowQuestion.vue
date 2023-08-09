<template>
    <AuthenticatedLayout>
        <Head :title="title" />

        <ShowQuestionItem :question="question" class="my-10" />
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ShowQuestionItem from "@/Components/Questions/ShowQuestionItem.vue";
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});

const title = computed(
    () => "Question | " + props.question.content.slice(0, 50) + "..."
);
</script>

<style scoped></style>
