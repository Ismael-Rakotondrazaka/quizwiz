<template>
    <table class="min-w-full mt-1 bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b max-w-[15px]">Id</th>
                <th class="px-4 py-2 border-b">Difficulty</th>
                <th class="px-4 py-2 border-b ">Score</th>
                <th class="px-4 py-2 border-b">Created</th>
                <th class="px-4 py-2 border-b">Delete</th>
            </tr>
        </thead>
        <tbody>
            <SessionItem
                v-for="(session, index) in sessions"
                :key="session.id"
                :rank="index"
                :session="session"
            />
        </tbody>
    </table>
</template>

<script setup>
import SessionItem from "@/Components/Sessions/SessionItem.vue";

const props = defineProps({
    sessions: {
        type: Array,
        required: false,
        default: () => [],
    },
});
</script>

<style scoped></style>
