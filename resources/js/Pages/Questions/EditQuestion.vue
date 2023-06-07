<template>
    <form @submit.prevent="submit">
        <div>
            <InputLabel for="content" value="Content" />

            <TextInput
                id="content"
                type="text"
                class="block w-full mt-1"
                v-model="form.content"
                required
                autofocus
                autocomplete="content"
            />

            <InputError class="mt-2" :message="form.errors.content" />
        </div>

        <div>
            <InputLabel for="difficulty" value="Difficulty" />

            <TextInput
                id="difficulty"
                type="text"
                class="block w-full mt-1"
                v-model="form.difficulty"
                required
                autofocus
                autocomplete="difficulty"
            />

            <InputError class="mt-2" :message="form.errors.difficulty" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Update
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    content: props.question.content,
    difficulty: props.question.difficulty,
});

const submit = () => {
    form.put(route("questions.update", props.question.id), {});
};
</script>

<style scoped></style>
