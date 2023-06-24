<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TheRegisterForm from "@/Components/Auth/TheRegisterForm.vue";
import { Head } from "@inertiajs/vue3";

</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <TheRegisterForm />
    </GuestLayout>
</template>
