<template>
    <ul class="flex flex-wrap items-start w-full gap-y-7 justify-evenly">
        <AnswerItem
            @answers:update="onAnswerUpdateHandler"
            v-for="(answer, index) in answers"
            :key="answer.id"
            :questionId="questionId"
            :answerId="answer.id"
            :answerSelectedId="answerSelectedId"
            :content="answer.content"
            :rank="index + 1"
            class="w-1/3 even:mr-3"
        />
    </ul>
</template>

<script setup>
import AnswerItem from "./AnswerItem.vue";

const props = defineProps({
    questionId: {
        type: Number,
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
});

const emit = defineEmits(["answers:update"]);

const onAnswerUpdateHandler = (questionId, answerId) => {
    emit("answers:update", questionId, answerId);
};
</script>

<style scoped></style>
