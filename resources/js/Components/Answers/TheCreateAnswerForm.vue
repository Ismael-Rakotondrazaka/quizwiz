<template>
    <div class="flex items-center justify-center min-h-screen">
        <CustomCard class="w-full md:w-1/2 lg:w-2/3">
            <form @submit.prevent="submit">
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                    Create an answer
                </h1>

                <div>
                    <InputLabel for="question" value="Question" />

                    <MarkdownContent
                        :markdown="question.content"
                        class="!mt-1"
                    />

                    <InputError class="mt-2" :message="form.errors.content" />
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
                                        :modelValue="form.content"
                                        @modelValue:change="
                                            (newValue) =>
                                                (form.content = newValue)
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

                <InputError class="mt-2" :message="form.errors.content" />

                <div class="flex items-center justify-end mt-9">
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
                        Create
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
import SecondaryLink from "@/Components/Links/SecondaryLink.vue";
import { useForm } from "@inertiajs/vue3";
import MarkdownEditor from "../TextEditor/MarkdownEditor.vue";
import MarkdownContent from "../TextEditor/MarkdownContent.vue";
import CustomCard from "../Commons/CustomCard.vue";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    content: "",
    is_correct: false,
});

const submit = () => {
    form.post(route("answers.store", props.question), {});
};
</script>

<style scoped></style>
