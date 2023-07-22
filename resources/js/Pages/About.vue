<template>
    <component :is="Layout">
        <TheAbout class="my-10" />
    </component>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TheAbout from "@/Components/About/TheAbout.vue";
import { computed } from "vue";

const props = defineProps({
    isAuthenticated: {
        type: Boolean,
        required: false,
        default: false,
    },
});

const Layout = computed(() => {
    return props.isAuthenticated ? AuthenticatedLayout : GuestLayout;
});
</script>

<style scoped></style>
