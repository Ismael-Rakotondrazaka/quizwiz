<template>
    <div>
        <pre><code>{{ question }}</code></pre>
        <Link :href="route('questions.edit', question.id)">Edit</Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});
</script>

<style scoped></style>
