<template>
    <label
        :for="props.for"
        class="relative inline-block px-20 py-3 ml-5 border-2 rounded-lg ring-4 ring-transparent hover:cursor-pointer transition-all"
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
            class="absolute top-0 left-0 inline-block py-1 pl-2 pr-4 rounded-tl-lg transition-all"
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

const mainClass = computed(() => (isChecked.value ? "bg-sky-600 text-white border-sky-600" : "bg-white text-slate-700 border-sky-400"));

const hoverClass = computed(() =>
    isChecked.value ? "" : "hover:ring-sky-400 hover:border-white"
);

const badgeClass = computed(() =>
    isChecked.value ? "bg-white text-black" : "bg-sky-400"
);
</script>

<style lang="scss" scoped></style>
