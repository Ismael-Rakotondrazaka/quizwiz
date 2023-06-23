<template>
    <Link
        :href="href"
        :method="props.method"
        :as="props.as"
        class="p-3 pb-1 text-2xl text-white border-b-2 border-transparent hover:border-white"
        :class="[mainClass]"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const page = usePage();

const props = defineProps({
    routeName: {
        type: String,
        required: true,
    },
    routeParameters: {
        type: Array,
        required: false,
        default: () => [],
    },
    method: {
        type: String,
        required: false,
        default: "get",
    },
    as: {
        type: String,
        required: false,
    },
});

const href = computed(() => route(props.routeName, props.routeParameters));

const a = ref({ ...route() });

const mainClass = computed(() => {
    console.log(props.routeName, route().current());
    return props.routeName === route().current()
        ? "border-white"
        : "";
});
</script>

<style scoped></style>
