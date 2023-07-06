<template>
    <tr :class="[background]">
        <td class="px-4 py-2 text-gray-600 border-b">{{ session.id }}</td>

        <td class="px-4 py-2 font-bold border-b" :class="[difficultyColor]">
            {{ formattedDifficulty }}
        </td>

        <td class="px-4 py-2 font-bold text-center text-green-700 border-b">
            {{ session.score }}
        </td>

        <td class="px-4 py-2 text-center text-blue-700 border-b">
            {{ createdAtFormatted }}
        </td>

        <td class="px-4 py-2 text-center border-b">
            <DeleteSession :session="session" />
        </td>
    </tr>
</template>

<script setup>
import { computed } from "vue";
import { useDateFormat } from "@vueuse/core";
import DeleteSession from "@/Components/Sessions/DeleteSession.vue";

const props = defineProps({
    session: {
        type: Object,
        required: true,
    },
    rank: {
        type: Number,
        required: false,
        default: 0,
    },
});

const createdAtFormatted = useDateFormat(
    props.session.created_at,
    "MMM D, YYYY, HH:mm A"
);

const background = computed(() =>
    props.rank % 2 ? "bg-slate-50" : "bg-slate-200"
);

const difficultyColor = computed(() => {
    switch (props.session.difficulty) {
        case "easy":
            return "text-green-700";
        case "medium":
            return "text-yellow-700";
        case "hard":
            return "text-red-700";
        default:
            return "text-gray-700";
    }
});

const formattedDifficulty = computed(() => {
    switch (props.session.difficulty) {
        case "easy":
            return "Easy";
        case "medium":
            return "Medium";
        case "hard":
            return "Hard";
        default:
            return "Unknown";
    }
});
</script>

<style scoped></style>
