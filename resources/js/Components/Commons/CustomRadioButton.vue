<template>
    <label
        :for="props.for"
        class="relative inline-block p-2 rounded-lg hover:cursor-pointer"
        :class="[mainClass, hoverClass]"
    >
        <input
            :id="props.for"
            type="radio"
            @change="changeHandler"
            name="input"
            :value="props.value"
            class="hidden"
            :checked="isChecked"
        />

        <span
            v-if="props.badge"
            class="absolute inline-block py-1 pl-2 pr-4 transition-all rounded-tl-lg -top-1 -left-1"
            :class="[badgeClass]"
            style="clip-path: polygon(100% 0, 74% 100%, 0 100%, 1% 0)"
        >
            {{ props.badge }}
        </span>

        <slot />
    </label>
</template>

<script setup>
import { computed, defineEmits } from "vue";

const props = defineProps({
    badge: {
        required: false,
        default: null,
    },
    value: {
        required: true,
    },
    modelValue: {
        required: true,
    },
    for: {
        required: false,
        default: "",
    },
});

const emit = defineEmits(["onValueChanged"]);

const changeHandler = (e) => {
    e.preventDefault();
    console.log(e.target.value);
    emit("onValueChanged", e.target.value);
};

const isChecked = computed(() => props.modelValue === props.value);

const mainClass = computed(() =>
    isChecked.value
        ? "bg-sky-600 text-white border-sky-600"
        : "bg-white text-slate-700 border-sky-400"
);

const hoverClass = computed(() =>
    isChecked.value ? "" : "hover:ring-sky-400 hover:border-white"
);

const badgeClass = computed(() =>
    isChecked.value ? "bg-sky-600" : "bg-sky-400"
);
</script>

<style lang="scss" scoped></style>
