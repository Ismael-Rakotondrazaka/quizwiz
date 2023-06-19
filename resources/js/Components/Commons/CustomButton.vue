<template>
    <button
        class="ml-5 bg-white shadow border-sky-400 relative px-20 py-3 rounded-lg font-bold text-xl flex justify-start items-left"
    >
        <span
            v-if="hasBadge"
            class="absolute top-0 left-0 inline-block py-1 pl-2 pr-4 rounded-tl-lg transition-all bg-sky-400"
            style="clip-path: polygon(100% 0, 74% 100%, 0 100%, 1% 0)"
        >
            <slot name="badge"
        /></span>
        <slot />
    </button>
</template>

<script setup>
import { computed, defineSlots } from "vue";
const slots = defineSlots();

const hasBadge = computed(() => !!slots["badge"]);
</script>

<style scoped></style>
