<template>
    <tr :class="[background]">
        <td class="px-4 py-2 border-b">{{ answer.id }}</td>

        <td class="px-4 py-2 border-b">
            <textarea
                :id="'answer-' + answer.id"
                class="w-full min-h-[5em] p-2 border border-gray-300 rounded-md"
                :value="answer.content"
                required
                disabled
            ></textarea>
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
                <span class="sr-only">Delete</span>
            </Link>
        </td>

        <td class="px-4 py-2 text-center border-b">
            <button @click.prevent="deleteAnswer">
                <fa-icon
                    icon="fa-solid fa-trash-can"
                    class="text-3xl text-red-400"
                />
                <span class="sr-only">Delete</span>
            </button>
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

const deleteAnswer = () => {};
</script>

<style scoped></style>
