<template>
    <div class="flex gap-x-2">
        <div v-for="(step, i) in props.steps" :key="i" class="flex-1 relative">
            <div
                :class="{
                    'bg-blue-500': i < currentStep,
                    'bg-gray-300': i >= currentStep,
                }"
                class="h-2 rounded transition-all"
            ></div>
            <span
                class="absolute top-0 -mt-4 left-1/2 transform -translate-x-1/2 bg-white rounded-full text-sm text-gray-600 px-3 py-1 ring-2 ring-sky-400"
            >
                {{ step }}
            </span>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    steps: {
        type: Array,
        required: false,
        default: () => [],
    },
    currentStep: {
        type: Number,
        required: false,
        default: 0,
    },
});
</script>

<style></style>
