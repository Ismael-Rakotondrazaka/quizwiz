<template>
    <div class="border border-gray-300 rounded-md">
        <div class="border-b">
            <button
                @click.prevent="toRawMode"
                class="px-5 py-3 border-r"
                :class="{
                    'bg-sky-200': mode === 'raw',
                }"
            >
                Raw
            </button>

            <button
                @click.prevent="toPreviewMode"
                class="px-5 py-3 border-r"
                :class="{
                    'bg-sky-200': mode === 'preview',
                }"
            >
                Preview
            </button>
        </div>

        <div class="p-3 bg-white">
            <textarea
                v-if="mode === 'raw'"
                id="question"
                class="w-full p-2 mr-2 min-h-[7em] rounded-md"
                :value="modelValue"
                required
                autofocus
                autocomplete="content"
                @input="onChangeHandler"
            />

            <MarkdownContent
                v-else-if="mode === 'preview'"
                :markdown="modelValue"
                class="w-1/2,"
            />
        </div>
    </div>
</template>

<script setup>
import MarkdownContent from "./MarkdownContent.vue";
import { ref } from "vue";

const props = defineProps({
    modelValue: {
        type: String,
    },
});

const mode = ref("raw");

const toRawMode = () => {
    mode.value = "raw";
};

const toPreviewMode = () => {
    mode.value = "preview";
};

const emit = defineEmits(["modelValue:change"]);

const onChangeHandler = (e) => {
    emit("modelValue:change", e.target.value);
};
</script>

<style scoped></style>
