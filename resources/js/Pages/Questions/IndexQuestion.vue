<template>
    <div>
        <pre><code>{{ paginationLinks }}</code></pre>

        <div v-for="(link, index) in paginationLinks" :key="index">
            <Link v-if="link.url" :href="link.url" v-html="link.label" />
            <span v-else v-html="link.label" />
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { computed, defineProps } from "@vue/runtime-core";

const props = defineProps({
    questionsPaginated: {
        type: Object,
        required: true,
    },
});

const questions = computed(() => {
    return props.questionsPaginated.data;
});

const paginationLinks = computed(() => {
    return props.questionsPaginated.links;
});
</script>

<style scoped></style>
