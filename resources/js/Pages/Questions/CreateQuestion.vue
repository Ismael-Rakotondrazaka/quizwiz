<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TheCreateQuestionForm from "@/Components/Questions/TheCreateQuestionForm.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <GuestLayout>

        <Head title="Create question" />

        <TheCreateQuestionForm class="my-20"/>
    </GuestLayout>
</template>
