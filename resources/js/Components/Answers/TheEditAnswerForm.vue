<template>
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-1/2"
        >
            <form @submit.prevent="submit">
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                    Edit an answer
                </h1>

                <div>
                    <InputLabel for="question" value="Question" />

                    <MarkdownContent
                        id="question"
                        :markdown="question.content"
                        class="!mt-1"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="content" value="Answer" />

                    <table
                        class="min-w-full mt-1 bg-white border border-gray-300"
                    >
                        <thead>
                            <tr>
                                <th class="w-full px-4 py-2 border-b">
                                    Content
                                </th>
                                <th class="px-4 py-2 border-b">Correct</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-slate-50">
                                <td class="px-4 py-2 border-b">
                                    <MarkdownEditor
                                        :model-value="form.content"
                                        @model-value:change="
                                            (newValue) => {
                                                form.content = newValue;
                                            }
                                        "
                                    />
                                </td>
                                <td class="px-4 py-2 text-center border-b">
                                    <input
                                        id="is-correct"
                                        type="checkbox"
                                        v-model="form.is_correct"
                                        class="w-7 h-7"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <InputError
                    class="mt-2"
                    :message="form.errors.content || form.errors.is_correct"
                />

                <div class="flex items-center justify-end mt-9">
                    <PrimaryButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Edit
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
import { useForm } from "@inertiajs/vue3";
import MarkdownContent from "../TextEditor/MarkdownContent.vue";
import MarkdownEditor from "../TextEditor/MarkdownEditor.vue";

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
    form.put(route("answers.update", [props.question.id, props.answer.id]), {});
};
</script>

<style scoped></style>
