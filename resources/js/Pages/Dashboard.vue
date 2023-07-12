<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <TheDashboard
            class="my-20"
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
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";
import TheDashboard from "@/Components/Dashboard/TheDashboard.vue";

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

const sessions = computed(() => props.sessionsPaginated.data);

const paginationLinks = computed(() => props.sessionsPaginated.links);
</script>
