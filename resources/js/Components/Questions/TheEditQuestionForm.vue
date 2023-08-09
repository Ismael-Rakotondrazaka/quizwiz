<template>
    <div class="flex items-center justify-center min-h-screen">
        <CustomCard class="w-full lg:w-2/3">
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
                    <SecondaryLink
                        :href="route('questions.show', [question.id])"
                        class=""
                    >
                        Cancel
                    </SecondaryLink>

                    <PrimaryButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Update
                    </PrimaryButton>
                </div>
            </form>
        </CustomCard>
    </div>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm, Link } from "@inertiajs/vue3";
import MarkdownEditor from "../TextEditor/MarkdownEditor.vue";
import CustomCard from "../Commons/CustomCard.vue";
import SecondaryLink from "../Links/SecondaryLink.vue";

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
