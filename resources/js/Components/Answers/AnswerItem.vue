<template>
    <li>
        <CustomRadioButton
            :for="'answer_' + answerId"
            :value="answerId"
            :badge="rank"
            :modelValue="answerSelectedId"
            @onValueChanged="onValueChangedTrigger"
            class="w-full"
        >
            {{ content }}
        </CustomRadioButton>
    </li>
</template>

<script setup>
import CustomRadioButton from "@/Components/Commons/CustomRadioButton.vue";

const props = defineProps({
    answerId: {
        type: Number,
        required: true,
    },
    questionId: {
        type: Number,
        required: true,
    },
    answerSelectedId: {
        type: Number,
        required: false,
        default: null,
    },
    content: {
        type: String,
        required: true,
    },
    rank: {
        type: Number,
        required: true,
    },
});

const emit = defineEmits(["answers:update"]);

const onValueChangedTrigger = () => {
    emit("answers:update", props.questionId, props.answerId);
};
</script>

<style scoped></style>
