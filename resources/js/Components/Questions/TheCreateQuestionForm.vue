<template>
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-2/3"
        >
            <form @submit.prevent="submit">
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                    Create a question
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

                <div class="mt-4">
                    <InputLabel for="difficulty" value="Answers" />

                    <table
                        class="min-w-full mt-1 bg-white border border-gray-300"
                    >
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b max-w-[15px]">
                                    No.
                                </th>
                                <th class="w-full px-4 py-2 border-b">
                                    Content
                                </th>
                                <th class="px-4 py-2 border-b">Correct</th>
                                <th class="px-4 py-2 border-b">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(answer, index) in form.answers"
                                :key="index"
                                :class="[
                                    index % 2 ? 'bg-slate-50' : 'bg-slate-200',
                                ]"
                            >
                                <td class="px-4 py-2 border-b">
                                    {{ index + 1 }}
                                </td>

                                <td class="px-4 py-2 border-b">
                                    <MarkdownEditor
                                        :model-value="answer.content"
                                        @model-value:change="
                                            (newValue) =>
                                                (answer.content = newValue)
                                        "
                                    />
                                </td>

                                <td class="px-4 py-2 text-center border-b">
                                    <input
                                        :id="'is-correct-' + index"
                                        type="checkbox"
                                        v-model="answer.is_correct"
                                        class="w-7 h-7"
                                    />
                                </td>

                                <td class="px-4 py-2 text-center border-b">
                                    <button
                                        @click.prevent="
                                            () => {
                                                removeAnswer(index);
                                            }
                                        "
                                    >
                                        <fa-icon
                                            icon="fa-solid fa-trash-can"
                                            class="text-3xl text-red-400"
                                        />
                                        <span class="sr-only">Remove</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button
                    @click.prevent="addNewAnswer"
                    class="px-5 py-3 my-5 rounded bg-sky-200"
                >
                    <span><fa-icon icon="fa-icon fa-plus" class="mr-2" /></span>
                    Add Answer
                </button>

                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Create
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
import { computed } from "vue";
import MarkdownEditor from "../TextEditor/MarkdownEditor.vue";

const form = useForm({
    content: "",
    difficulty: "medium",
    answers: [
        { content: "", is_correct: false },
        { content: "", is_correct: false },
        { content: "", is_correct: false },
        { content: "", is_correct: false },
    ],
});

const addNewAnswer = () => {
    form.answers.push({ content: "", is_correct: false });
};

const submit = () => {
    form.post(route("questions.store"), {});
};

const canRemoveAnswer = computed(() => {
    return form.answers.length > 4;
});

const removeAnswer = (index) => {
    if (canRemoveAnswer.value) {
        form.answers.splice(index, 1);
    }
};
</script>

<style scoped></style>
