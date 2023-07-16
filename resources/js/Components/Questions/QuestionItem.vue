<template>
    <li v-if="rank === currentStep">
        <div
            class="border rounded-lg mt-20 mb-10 !rounded-tl-xl bg-sky-300 w-2/3 mx-auto"
        >
            <fa-icon
                icon="fa-icon fa-question-circle"
                class="block mx-auto -translate-y-10 text-7xl text-sky-600"
            />

            <MarkdownContent :markdown="content" class="!border-sky-300" />
        </div>

        <AnswerList
            @answers:update="onAnswerUpdateHandler"
            :answers="answers"
            :questionId="questionId"
            :answerSelectedId="answerSelectedId"
        />
    </li>
</template>

<script setup>
import AnswerList from "../Answers/AnswerList.vue";
import MarkdownContent from "../TextEditor/MarkdownContent.vue";

const props = defineProps({
    questionId: {
        type: Number,
        required: true,
    },
    difficulty: {
        type: String,
        required: true,
    },
    content: {
        type: String,
        required: true,
    },
    answers: {
        type: Array,
        required: false,
        default: () => [],
    },
    answerSelectedId: {
        type: Number,
        required: false,
        default: null,
    },
    rank: {
        type: Number,
        required: true,
    },
    currentStep: {
        type: Number,
        required: true,
    },
});

const emit = defineEmits(["answers:update"]);

const onAnswerUpdateHandler = (questionId, answerId) => {
    emit("answers:update", questionId, answerId);
};
</script>

<style lang="scss" scoped></style>
