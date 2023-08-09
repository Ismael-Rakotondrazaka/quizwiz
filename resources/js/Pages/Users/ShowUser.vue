<template>
    <AuthenticatedLayout>
        <Head :title="title" />

        <ShowUserItem
            :user="user"
            :sessions="sessions"
            :paginationLinks="paginationLinks"
            class="my-10"
        />
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "@vue/runtime-core";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ShowUserItem from "@/Components/Users/ShowUserItem.vue";
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    sessionsPaginated: {
        type: Object,
        required: true,
    },
});

const sessions = computed(() => {
    return props.sessionsPaginated.data;
});

const paginationLinks = computed(() => {
    return props.sessionsPaginated.links;
});

const title = computed(
    () => "User | " + props.user.first_name + " " + props.user.last_name
);
</script>

<style scoped></style>
