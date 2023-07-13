<template>
    <form @submit.prevent>
        <ul>
            <QuestionItem
                @answers:update="onAnswerUpdateHandler"
                v-for="(question, index) in questions"
                :key="question.id"
                :questionId="question.id"
                :answers="question.answers"
                :answerSelectedId="questionIdAnswerId[question.id]"
                :content="question.content"
                :difficulty="question.difficulty"
                :rank="index + 1"
                :currentStep="currentStep"
            />
        </ul>

        <div class="flex items-center justify-end mt-9">
            <div v-if="isTheLast">
                <PrimaryButton class="ml-4" @click.prevent="submitHandler">
                    Submit
                </PrimaryButton>
            </div>
            <div v-else>
                <PrimaryButton class="ml-4" @click.prevent="nextHandler">
                    Next
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import QuestionItem from "./QuestionItem.vue";
import { ref, computed } from "vue";

const props = defineProps({
    questions: {
        type: Array,
        required: true,
    },
    questionIdAnswerId: {
        type: Object,
        required: false,
        default: () => [],
    },
    currentStep: {
        type: Number,
        required: true,
    },
    stepsCount: {
        type: Number,
        required: true,
    },
});

const answers = ref(
    props.questions.map((question) => {
        return {
            question_id: question.id,
            answer_id: null,
        };
    })
);

const emit = defineEmits([
    "answers:update",
    "questions:next",
    "sessions:create",
]);

const isTheLast = computed(() => props.currentStep === props.stepsCount);

const onAnswerUpdateHandler = (questionId, answerId) => {
    emit("answers:update", questionId, answerId);
};

const nextHandler = () => {
    emit("questions:next");
};

const submitHandler = () => {
    emit("sessions:create");
};
</script>

<style scoped></style>
