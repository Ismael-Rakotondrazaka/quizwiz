<template>
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-2/3">
            <div>
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">Question {{ question.id }}: </h1>

                <div>
                    <InputLabel for="content" value="Content" />

                    <textarea id="content" class="w-full p-2 mt-1 border border-gray-300 rounded-md min-h-[7em]"
                        :value="question.content" required autofocus disabled />
                </div>

                <div class="mt-4">
                    <InputLabel for="difficulty" value="Difficulty" />

                    <div class="inline-block w-full mt-1">
                        <select id="difficulty"
                            class="block w-full px-4 py-2 pr-8 bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-primary focus:border-primary-dark"
                            v-model="question.difficulty" disabled>
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4 gap-x-7">
                    <DeleteQuestion :question="question" />

                    <Link :href="route('questions.edit', [question.id])"
                        class="inline-block px-5 py-3 my-5 rounded bg-sky-200">
                    <fa-icon icon="fa-icon fa-pen-to-square" class="mr-2" />
                    Edit
                    </Link>
                </div>
            </div>

            <hr class="my-10 border-t-2">

            <div>
                <div class="mt-4">
                    <InputLabel for="answer" value="Answers" />

                    <table class="min-w-full mt-1 bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b max-w-[15px]">Id</th>
                                <th class="w-full px-4 py-2 border-b">Content</th>
                                <th class="px-4 py-2 border-b">Correct</th>
                                <th class="px-4 py-2 border-b">Edit</th>
                                <th class="px-4 py-2 border-b">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(answer, index) in question.answers" :key="answer.id"
                                :class="[index % 2 ? 'bg-slate-50' : 'bg-slate-200']">
                                <td class="px-4 py-2 border-b">{{ answer.id }}</td>

                                <td class="px-4 py-2 border-b">
                                    <textarea :id="'answer-' + index"
                                        class="w-full min-h-[5em] p-2 border border-gray-300 rounded-md"
                                        :value="answer.content" required disabled></textarea>
                                </td>

                                <td class="px-4 py-2 text-center border-b">
                                    <input :id="'is-correct-' + index" type="checkbox" :checked="answer.is_correct"
                                        class="w-7 h-7" disabled />
                                </td>

                                <td class="px-4 py-2 text-center border-b">
                                    <Link :href="route('answers.edit', [question.id, answer.id])">
                                    <fa-icon icon="fa-solid fa-pen-to-square" class="text-3xl text-sky-400" />
                                    <span class="sr-only">Delete</span>
                                    </Link>
                                </td>

                                <td class="px-4 py-2 text-center border-b">
                                    <button @click.prevent="() => {
                                        deleteAnswer(answer.id);
                                    }">
                                        <fa-icon icon="fa-solid fa-trash-can" class="text-3xl text-red-400" />
                                        <span class="sr-only">Delete</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <Link :href="route('answers.create', [question.id])" class="inline-block px-5 py-3 my-5 rounded bg-sky-200">
                <span><fa-icon icon="fa-icon fa-plus" class="mr-2" /></span> Add an answer
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import DeleteQuestion from "@/Components/Questions/DeleteQuestion.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});

const deleteAnswer = () => {
    console.log("delete");
}

</script>

<style></style>