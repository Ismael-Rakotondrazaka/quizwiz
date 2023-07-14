<template>
    <div
        v-html="html"
        class="markdown-body border border-gray-300 rounded-md min-h-[7em]"
    ></div>
</template>

<script setup>
import { markdownParser } from "@/Utils/Markdown/markdownParser";
import { computed } from "vue";

const props = defineProps({
    markdown: {
        type: String,
        required: true,
    },
});

const html = computed(() => markdownParser(props.markdown));
</script>

<style scoped></style>
