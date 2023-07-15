<template>
    <tr :class="[background]">
        <td class="px-4 py-2 border-b">{{ question.id }}</td>

        <td class="px-4 py-2 border-b">
            <MarkdownContent
                :markdown="question.content"
                :id="'question-' + question.id"
            />
        </td>

        <td class="px-4 py-2 border-b">{{ difficulty }}</td>

        <td class="px-4 py-2 text-center border-b">
            <Link :href="route('questions.show', [question.id])">
                <fa-icon
                    icon="fa-solid fa-arrow-up-right-from-square"
                    class="text-3xl text-sky-400"
                />
                <span class="sr-only">Open</span>
            </Link>
        </td>
    </tr>
</template>

<script setup>
import MarkdownContent from "../TextEditor/MarkdownContent.vue";
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    question: {
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

const difficultyFormatted = {
    easy: "Easy",
    medium: "Medium",
    hard: "Hard",
};

const difficulty = computed(
    () => difficultyFormatted[props.question.difficulty]
);
</script>

<style scoped></style>
