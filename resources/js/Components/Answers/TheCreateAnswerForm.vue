<template>
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-2/3"
        >
            <form @submit.prevent="submit">
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                    Create an answer
                </h1>

                <div>
                    <InputLabel for="question" value="Question" />

                    <textarea
                        id="question"
                        readonly
                        class="w-full p-2 mt-1 border border-gray-300 bg-gray-100 rounded-md min-h-[7em] cursor-not-allowed focus:border-gray-300"
                        v-model="props.question.content"
                        required
                        autofocus
                        autocomplete="content"
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
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import MarkdownEditor from "../TextEditor/MarkdownEditor.vue";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    content: `
# Heading 1

## Heading 2

### Heading 3

**Bold Text**

*Italic Text*

~~Strikethrough Text~~

[Link](https://www.example.com)

[Link with Title](https://www.example.com "Link Title")

- List Item 1
- List Item 2
- List Item 3

1. Ordered Item 1
2. Ordered Item 2
3. Ordered Item 3

> Blockquote

\`\`\`javascript
// Code block
const message = 'Hello, world!';
console.log(message);
\`\`\`

![Image](image.jpg)

| Column 1 | Column 2 |
| -------- | -------- |
| Row 1    | Row 1    |
| Row 2    | Row 2    |
| Row 1    | Row 1    |
| Row 2    | Row 2    |

Horizontal Rule:

---

`,
    is_correct: false,
});

const submit = () => {
    form.post(route("answers.store", props.question), {});
};
</script>

<style scoped></style>
