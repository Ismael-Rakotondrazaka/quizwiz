<template>
    <div>
        <pre><code>{{ question }}</code></pre>
        <Link :href="route('questions.edit', question.id)">Edit</Link>
    </div>

    <ul>
        'ses'
        <li>
            <h1>{{ index + 1 }}. {{ question.content }}</h1>
            <ul>
                <li
                    v-for="(answer, index2) in question.answers"
                    :key="answer.id"
                >
                    <label>
                        <input
                            type="radio"
                            :value="answer.id"
                            v-model="answers[index]['answer_id']"
                        />
                        {{ index2 }}. {{ answer.content }}
                    </label>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});
</script>

<style scoped></style>
