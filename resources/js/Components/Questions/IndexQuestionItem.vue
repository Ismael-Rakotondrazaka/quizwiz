<template>
    <tr :class="[background]">
        <td class="px-4 py-2 border-b">{{ question.id }}</td>

        <td class="px-4 py-2 border-b">
            <textarea
                :id="'question-' + question.id"
                class="w-full min-h-[5em] p-2 border border-gray-300 rounded-md"
                :value="question.content"
                required
                disabled
            ></textarea>
        </td>

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
</script>

<style scoped></style>
