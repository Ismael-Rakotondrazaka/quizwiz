<template>
    <AuthenticatedLayout>
        <Head :title="title" />

        <IndexQuestionList
            :questions="questions"
            :paginationLinks="paginationLinks"
            class="my-10"
        />
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import IndexQuestionList from "@/Components/Questions/IndexQuestionList.vue";
import { Head } from "@inertiajs/vue3";
import { computed, defineProps } from "@vue/runtime-core";

const props = defineProps({
    questionsPaginated: {
        type: Object,
        required: true,
    },
});

const questions = computed(() => {
    return props.questionsPaginated.data;
});

const paginationLinks = computed(() => {
    return props.questionsPaginated.links;
});

const title = computed(
    () => "Questions | Page " + props.questionsPaginated.current_page
);
</script>

<style scoped></style>
