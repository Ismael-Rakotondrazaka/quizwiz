<template>
    <AuthenticatedLayout>

        <Head :title="title" />

        <ShowQuestionItem :question="question" />
    </AuthenticatedLayout>

    <!-- <ul>
        'ses'
        <li>
            <h1>{{ index + 1 }}. {{ question.content }}</h1>
            <ul>
                <li
                    v-for="(answer, index2) in question.answers"
                    :key="answer.id"
                >
                    <label>
                        <input
                            type="radio"
                            :value="answer.id"
                            v-model="answers[index]['answer_id']"
                        />
                        {{ index2 }}. {{ answer.content }}
                    </label>
                </li>
            </ul>
        </li>
    </ul> -->
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ShowQuestionItem from "@/Components/Questions/ShowQuestionItem.vue";
import { Link, Head } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});

const title = computed(() => "Question | " + props.question.content.slice(0, 50) + "...");
</script>

<style scoped></style>
