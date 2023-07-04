<template>
    <AuthenticatedLayout>
        <Head :title="title" />

        <UserList
            :users="users"
            :paginationLinks="paginationLinks"
            class="my-20"
        />
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UserList from "@/Components/Users/UserList.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { computed, defineProps } from "@vue/runtime-core";

const props = defineProps({
    usersPaginated: {
        type: Object,
        required: true,
    },
});

const users = computed(() => {
    return props.usersPaginated.data;
});

const paginationLinks = computed(() => {
    return props.usersPaginated.links;
});

const title = computed(
    () => "Users | Page " + props.usersPaginated.current_page
);
</script>

<style scoped></style>
