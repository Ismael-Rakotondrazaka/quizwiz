<template>
    <table class="min-w-full mt-1 bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b max-w-[15px]">Id</th>
                <th class="w-full px-4 py-2 border-b">Content</th>
                <th class="px-4 py-2 border-b">Correct</th>
                <th class="px-4 py-2 border-b">Edit</th>
                <th class="px-4 py-2 border-b">Remove</th>
            </tr>
        </thead>
        <tbody>
            <IndexAnswerItem
                v-for="(answer, index) in question.answers"
                :key="answer.id"
                :rank="index"
                :answer="answer"
                :question="question"
            />
        </tbody>
    </table>
</template>

<script setup>
import IndexAnswerItem from "@/Components/Answers/IndexAnswerItem.vue";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});

const deleteAnswer = () => {
    console.log("delete");
};
</script>

<style scoped></style>
