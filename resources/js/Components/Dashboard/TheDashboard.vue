<template>
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-1/2"
        >
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                Dashboard :
            </h1>

            <div class="w-1/2 max-w-[20rem] mx-auto">
                <SessionDoughnutChart
                    :easyCount="easyCount"
                    :mediumCount="mediumCount"
                    :hardCount="hardCount"
                />
            </div>

            <hr class="my-10 border-t-2" />

            <div>
                <InputLabel for="sessions" value="Sessions" />

                <Link :href="route('sessions.create')">
                    <PrimaryButton class="my-3">
                        <fa-icon icon="fa-solid fa-plus" class="mr-3" /> New
                        session
                    </PrimaryButton>
                </Link>

                <UserSessionList :sessions="sessions" />

                <PaginationLinkList
                    :paginationLinks="paginationLinks"
                    class="mt-7"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import UserSessionList from "@/Components/Sessions/UserSessionList.vue";
import PaginationLinkList from "@/Components/Commons/PaginationLinkList.vue";
import SessionDoughnutChart from "../Sessions/SessionDoughnutChart.vue";
import PrimaryButton from "../PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    sessions: {
        type: Array,
        required: false,
        default: () => [],
    },
    paginationLinks: {
        type: Object,
        required: true,
    },
    easyCount: {
        type: Number,
        required: false,
        default: 0,
    },
    mediumCount: {
        type: Number,
        required: false,
        default: 0,
    },
    hardCount: {
        type: Number,
        required: false,
        default: 0,
    },
});
</script>

<style lang="scss" scoped></style>
