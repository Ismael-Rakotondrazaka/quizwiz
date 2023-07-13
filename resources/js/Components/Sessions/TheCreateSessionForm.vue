<template>
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-1/2"
        >
            <CustomStepper
                :steps-count="stepsCount"
                :currentStep="currentStep"
            />

            <QuestionList
                @answers:update="onAnswerUpdateHandler"
                @questions:next="onQuestionNextHandler"
                @sessions:create="onSessionCreateHandler"
                :stepsCount="stepsCount"
                :questions="questionsWithRandomAnswersOrder"
                :questionIdAnswerId="questionIdAnswerId"
                :currentStep="currentStep"
            />
        </div>
    </div>
</template>

<script setup>
import { defineProps, computed, ref, watch } from "@vue/runtime-core";
import CustomStepper from "@/Components/Commons/CustomStepper.vue";
import QuestionList from "../Questions/QuestionList.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    difficulty: {
        type: String,
        required: true,
    },
    questions: {
        type: Array,
        required: false,
        default: () => [],
    },
});

const questionsWithRandomAnswersOrder = computed(() => {
    return props.questions.map((question) => {
        return {
            ...question,
            answers: question.answers.sort(() => {
                return 0.5 - Math.random();
            }),
        };
    });
});

const questionIdAnswerId = ref(
    (() => {
        const result = {};

        questionsWithRandomAnswersOrder.value.forEach((question) => {
            result[question.id] = null;
        });

        return result;
    })()
);

watch(questionsWithRandomAnswersOrder, (newValue) => {
    const result = {};

    newValue.value.foreach((question) => {
        result[question.id] = null;
    });

    questionIdAnswerId.value = result;
});

const answers = computed(() => {
    let result = [];

    for (const key in questionIdAnswerId.value) {
        if (Object.hasOwnProperty.call(questionIdAnswerId.value, key)) {
            result.push({
                question_id: +key,
                answer_id: questionIdAnswerId.value[key],
            });
        }
    }

    return result;
});

const stepsCount = computed(() => props.questions.length);

const currentStep = ref(1);

const onSessionCreateHandler = () => {
    router.post(route("sessions.store"), {
        answers: answers.value,
        difficulty: props.difficulty,
    });
};

const onAnswerUpdateHandler = (questionId, answerId) => {
    questionIdAnswerId.value[questionId] = answerId;
};

const onQuestionNextHandler = () => {
    currentStep.value++;
};
</script>

<style scoped></style>
