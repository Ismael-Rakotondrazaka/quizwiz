<template>
    <AuthenticatedLayout>
        <Head title="Sessions" />

        <TheCreateSessionForm
            v-if="isSessionStarted"
            :difficulty="props.difficulty"
            :questions="props.questions"
        />
        <TheStartSessionForm v-else :difficulty="props.difficulty" />
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TheCreateSessionForm from "@/Components/Sessions/TheCreateSessionForm.vue";
import TheStartSessionForm from "@/Components/Sessions/TheStartSessionForm.vue";
import { defineProps, computed } from "@vue/runtime-core";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    difficulty: {
        type: String,
    },
    questions: {
        type: Array,
    },
});

const isSessionStarted = computed(
    () => !!props.difficulty && props.questions.length > 0
);
</script>
