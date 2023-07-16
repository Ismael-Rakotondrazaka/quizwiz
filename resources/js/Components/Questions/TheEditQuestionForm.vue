<template>
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-1/3"
        >
            <form @submit.prevent="submit">
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                    Edit a question
                </h1>

                <div>
                    <InputLabel for="content" value="Content" />

                    <MarkdownEditor
                        :model-value="form.content"
                        @model-value:change="
                            (newValue) => (form.content = newValue)
                        "
                        class="!mt-1"
                    />

                    <InputError class="mt-2" :message="form.errors.content" />
                </div>

                <div class="mt-4">
                    <InputLabel for="difficulty" value="Difficulty" />

                    <div class="inline-block w-full mt-1">
                        <select
                            id="difficulty"
                            class="block w-full px-4 py-2 pr-8 bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-primary focus:border-primary-dark"
                            v-model="form.difficulty"
                        >
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>

                    <InputError
                        class="mt-2"
                        :message="form.errors.difficulty"
                    />
                </div>

                <div class="flex items-center justify-end mt-8">
                    <Link
                        :href="route('questions.show', [question.id])"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-black uppercase transition duration-150 ease-in-out bg-gray-300 border border-transparent rounded-md hover:bg-gray-400 focus:bg-gray-500 active:bg-gray-500 focus:outline-none"
                    >
                        Cancel
                    </Link>

                    <PrimaryButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Update
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm, Link } from "@inertiajs/vue3";
import MarkdownEditor from "../TextEditor/MarkdownEditor.vue";

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
