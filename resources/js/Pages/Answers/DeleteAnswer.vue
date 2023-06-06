<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

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

const form = useForm({
    content: props.answer.content,
    is_correct: props.answer.is_correct,
});

const submit = () => {
    form.delete(
        route("answers.destroy", [props.question.id, props.answer.id]),
        {}
    );
};
</script>

<template>
    <GuestLayout>
        <Head title="Delete answer" />

        {{ answer }}

        <form @submit.prevent="submit">

            <InputError class="mt-2" :message="form.errors.is_correct" />

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Delete
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
