<template>
    <li class="block">
        <Link
            v-if="paginationLink.url"
            :href="paginationLink.url"
            v-html="paginationLink.label"
            class="block px-5 py-2 font-bold rounded-md"
            :class="[backgroundColor]"
        />
        <span
            v-else
            v-html="paginationLink.label"
            class="block px-5 py-2 font-bold rounded-md hover:cursor-pointer"
            :class="[backgroundColor]"
        />
    </li>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    paginationLink: {
        type: Object,
        required: true,
    },
});

const backgroundColor = computed(() =>
    props.paginationLink.active ? "bg-sky-500" : "bg-gray-300"
);
</script>

<style scoped></style>
