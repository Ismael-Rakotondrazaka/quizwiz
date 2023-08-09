<template>
    <tr :class="[background]">
        <td class="px-4 py-2 border-b">{{ answer.id }}</td>

        <td class="px-4 py-2 border-b">
            <MarkdownContent
                :markdown="answer.content"
                :id="'answer-' + answer.id"
            />
        </td>

        <td class="px-4 py-2 text-center border-b">
            <input
                :id="'is-correct-' + answer.id"
                type="checkbox"
                :checked="answer.is_correct"
                class="w-7 h-7"
                disabled
            />
        </td>

        <td class="px-4 py-2 text-center border-b">
            <Link :href="route('answers.edit', [question.id, answer.id])">
                <fa-icon
                    icon="fa-solid fa-pen-to-square"
                    class="text-3xl text-sky-400"
                />
                <span class="sr-only">Edit</span>
            </Link>
        </td>

        <td class="px-4 py-2 text-center border-b">
            <DeleteAnswer :question="question" :answer="answer" />
        </td>
    </tr>
</template>

<script setup>
import DeleteAnswer from "@/Components/Answers/DeleteAnswer.vue";
import MarkdownContent from "../TextEditor/MarkdownContent.vue";
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
    answer: {
        type: Object,
        required: true,
    },
    rank: {
        type: Number,
        required: false,
        default: 0,
    },
});

const background = computed(() =>
    props.rank % 2 ? "bg-slate-50" : "bg-slate-200"
);

</script>

<style scoped></style>
