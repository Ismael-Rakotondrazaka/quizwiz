<template>
    <div class="flex items-center justify-center min-h-screen">
        <CustomCard class="w-full lg:w-2/3">
            <GoBack class="absolute" />

            <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                Questions:
            </h1>

            <PrimaryLink :href="route('questions.create')" class="my-3">
                <fa-icon icon="fa-solid fa-plus" class="mr-3" /> New question
            </PrimaryLink>

            <table class="min-w-full mt-1 bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b max-w-[15px]">Id</th>
                        <th class="w-full px-4 py-2 border-b">Content</th>
                        <th class="w-full px-4 py-2 border-b">Difficulty</th>
                        <th class="px-4 py-2 border-b">Open</th>
                    </tr>
                </thead>
                <tbody>
                    <IndexQuestionItem
                        v-for="(question, index) in questions"
                        :key="question.id"
                        :rank="index"
                        :question="question"
                    />
                </tbody>
            </table>

            <PaginationLinkList
                :paginationLinks="paginationLinks"
                class="mt-7"
            />
        </CustomCard>
    </div>
</template>

<script setup>
import IndexQuestionItem from "@/Components/Questions/IndexQuestionItem.vue";
import PaginationLinkList from "../Commons/PaginationLinkList.vue";
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "../PrimaryButton.vue";
import GoBack from "../Commons/GoBack.vue";
import CustomCard from "../Commons/CustomCard.vue";
import PrimaryLink from "../Links/PrimaryLink.vue";

const props = defineProps({
    questions: {
        type: Array,
        required: false,
        default: () => [],
    },
    paginationLinks: {
        type: Object,
        required: true,
    },
});
</script>

<style scoped></style>
