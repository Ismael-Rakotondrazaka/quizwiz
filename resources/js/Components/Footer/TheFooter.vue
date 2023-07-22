<template>
    <footer class="px-4 py-8 text-white bg-blue-600">
        <div class="container mx-auto">
            <div class="mb-4 text-center">
                <p class="text-xl">Thank You for Exploring QuizWiz!</p>
                <p class="mt-2 text-sm">
                    We appreciate your interest in mastering Vue.js with us.
                </p>
            </div>
            <div class="text-center">
                <Link
                    :href="href"
                    class="px-5 py-2 text-lg text-white uppercase border-2 rounded-full bg-sky-800/80 fond-bold"
                    >Start</Link
                >
            </div>
            <hr class="my-6 border-blue-400" />
            <div class="text-sm text-center">
                <p>&copy; {{ date }} QuizWiz. All rights reserved.</p>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { useDateFormat } from "@vueuse/core";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    isAuthenticated: {
        type: Boolean,
        required: false,
        default: false,
    },
});

const date = useDateFormat(new Date(), "YYYY");

const href = computed(() =>
    props.isAuthenticated ? route("dashboard") : route("login")
);
</script>

<style scoped></style>
