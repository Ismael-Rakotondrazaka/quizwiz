<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <TheStarDisplayer :stars="stars" :shown="haveStar" />

        <TheDashboard
            class="my-10"
            :sessions="sessions"
            :paginationLinks="paginationLinks"
            :easyCount="easyCount"
            :mediumCount="mediumCount"
            :hardCount="hardCount"
        />
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import TheDashboard from "@/Components/Dashboard/TheDashboard.vue";
import TheStarDisplayer from "@/Components/Stars/TheStarDisplayer.vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    sessionsPaginated: {
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

const page = usePage();

const haveStar = computed(() => !!page.props.ziggy?.query?.stars);

const stars = computed(() => (haveStar ? +page.props.ziggy.query.stars : 0));

const sessions = computed(() => props.sessionsPaginated.data);

const paginationLinks = computed(() => props.sessionsPaginated.links);
</script>
