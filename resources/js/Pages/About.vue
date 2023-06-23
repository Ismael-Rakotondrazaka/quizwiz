<template>
    <component :is="Layout">
        <div>About</div>
    </component>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { computed, ref } from 'vue';

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
