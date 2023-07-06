<template>
    <AuthenticatedLayout>
        <Head :title="title" />

        <TheEditUserForm :user="user" class="my-20" />
    </AuthenticatedLayout>
</template>

<script setup>
import TheEditUserForm from "@/Components/Users/TheEditUserForm.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, Head } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const title = computed(
    () => "Edit User | " + props.user.first_name + " " + props.user.last_name
);
</script>

<style scoped></style>
