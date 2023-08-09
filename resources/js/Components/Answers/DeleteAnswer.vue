<template>
    <VDropdown
        :positioning-disabled="true"
        @apply-show="toggleDeleteAnswer"
        @apply-hide="toggleDeleteAnswer"
    >
        <button>
            <fa-icon
                icon="fa-solid fa-trash-can"
                class="text-3xl text-red-400"
            />
            <span class="sr-only">Delete</span>
        </button>

        <template #popper="{ hide }">
            <div class="px-3 bg-red-400 py-7">
                <fa-icon
                    icon="fa-icon fa-exclamation-triangle"
                    class="block mx-auto text-6xl text-white"
                />
            </div>
            <div class="w-full max-w-md p-3 text-center">
                <h2 class="text-2xl font-bold text-red-500">
                    Delete the answer ?
                </h2>
                <p class="text-lg">The answer will be deleted.</p>
                <p class="text-lg">
                    This action is
                    <span class="font-bold text-red-400 underline"
                        >irreversible</span
                    >.
                </p>

                <InputError class="mt-2" :message="form.errors.is_correct" />

                <div
                    class="flex items-center justify-center w-full mt-5 gap-x-5"
                >
                    <DangerButton @click="destroyAnswer" class="">
                        Yes, delete
                    </DangerButton>

                    <SecondaryButton @click="hide" class="">
                        Cancel
                    </SecondaryButton>
                </div>
            </div>
        </template>
    </VDropdown>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "../SecondaryButton.vue";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
    answer: {
        type: Object,
        required: true,
    },
});

const isDeleteAnswerOpened = ref(false);

const toggleDeleteAnswer = () => {
    if (isDeleteAnswerOpened.value) {
        document.body.classList.remove("no-scroll");
    } else {
        document.body.classList.add("no-scroll");
    }
    form.errors.is_correct = null;
    isDeleteAnswerOpened.value = !isDeleteAnswerOpened.value;
};

const form = useForm({
    is_correct: props.answer.isCorrect,
});

const destroyAnswer = () => {
    form.delete(route("answers.destroy", [props.question.id, props.answer.id]));
};
</script>

<style scoped></style>
