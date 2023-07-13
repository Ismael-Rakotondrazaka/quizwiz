<template>
    <div class="flex gap-x-2">
        <div v-for="(_, i) in stepsCount" :key="i" class="relative flex-1">
            <div
                :class="{
                    'bg-blue-500': i < currentStep,
                    'bg-gray-300': i >= currentStep,
                }"
                class="h-2 transition-all rounded"
            ></div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    stepsCount: {
        type: Number,
        required: false,
        default: 0,
    },
    currentStep: {
        type: Number,
        required: false,
        default: 0,
    },
});
</script>

<style></style>
