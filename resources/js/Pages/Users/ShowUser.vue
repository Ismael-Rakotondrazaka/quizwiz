<template>
    <div>
        <pre><code>{{ user }}</code></pre>
    </div>
</template>

<script setup>
import { defineProps } from "@vue/runtime-core";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});
</script>

<style scoped></style>
