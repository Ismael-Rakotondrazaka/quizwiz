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
    form.put(
        route("answers.update", [props.question.id, props.answer.id]),
        {}
    );
};
</script>

<template>
    <GuestLayout>
        <Head title="Adit answer" />

        {{ answer }}

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="content" value="Content" />

                <TextInput
                    id="content"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.content"
                    required
                    autofocus
                    autocomplete="content"
                />

                <InputError class="mt-2" :message="form.errors.content" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox
                        name="is_correct"
                        v-model:checked="form.is_correct"
                    />
                    <span class="ml-2 text-sm text-gray-600">Is correct</span>
                </label>
            </div>

            <InputError class="mt-2" :message="form.errors.is_correct" />

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Edit
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
