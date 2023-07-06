<template>
    <VDropdown :positioning-disabled="true" @apply-show="toggleDeleteQuestion" @apply-hide="toggleDeleteQuestion">
        <button class="inline-block px-5 py-3 my-5 bg-red-200 rounded">
            <fa-icon icon="fa-icon fa-trash-can" class="mr-2" />
            Delete
        </button>

        <template #popper="{ hide }">
            <div class="px-3 bg-red-400 py-7"><fa-icon icon="fa-icon fa-exclamation-triangle"
                    class="block mx-auto text-6xl text-white" /></div>
            <div class="w-full max-w-md p-3 text-center">
                <h2 class="text-2xl font-bold text-red-500">Delete the question ?</h2>
                <p class="text-lg">The question and its answers will be deleted.</p>
                <p class="text-lg">This action is <span class="font-bold text-red-400 underline">irreversible</span>.</p>

                <div class="flex items-center justify-center w-full mt-5 gap-x-5">
                    <button @click="destroyQuestion"
                        class="block px-4 py-2 tracking-widest text-white uppercase bg-red-400 rounded-full leading-2">Yes,
                        delete</button>

                    <button @click="hide"
                        class="block px-4 py-2 tracking-widest uppercase rounded-full bg-slate-300 leading-2">Cancel</button>
                </div>
            </div>
        </template>
    </VDropdown>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});

const isDeleteQuestionOpened = ref(false);

const toggleDeleteQuestion = () => {
    if (isDeleteQuestionOpened.value) {
        document.body.classList.remove('no-scroll')
    } else {
        document.body.classList.add('no-scroll');
    }

    isDeleteQuestionOpened.value = !isDeleteQuestionOpened.value;
}

const form = useForm({});

const destroyQuestion = () => {
    form.delete(route("questions.destroy", [props.question.id]));
};
</script>

<style scoped>
</style>