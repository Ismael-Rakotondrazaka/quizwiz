<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, router } from "@inertiajs/vue3";
import { defineProps, computed, ref, watch } from "@vue/runtime-core";

const props = defineProps({
    difficulty: {
        type: String,
    },
    questions: {
        type: Array,
    },
});

const difficulty = ref(props.difficulty);

watch(
    () => props.difficulty,
    (newValue) => {
        difficulty.value = newValue;
    }
);

const isSessionStarted = computed(
    () => !!props.difficulty && props.questions.length > 0
);

const startSession = () => {
    router.post(route("sessions.start"), {
        difficulty: difficulty.value,
    });
};

const questionsWithRandomAnswersOrder = computed(() => {
    return props.questions.map((question) => {
        return {
            ...question,
            answers: question.answers.sort(() => {
                return 0.5 - Math.random();
            }),
        };
    });
});

const answers = ref(
    questionsWithRandomAnswersOrder.value.map((question) => {
        return {
            question_id: question.id,
            answer_id: null,
        };
    })
);

watch(questionsWithRandomAnswersOrder, (newValue) => {
    answers.value = newValue.map((question) => {
        return {
            question_id: question.id,
            answer_id: null,
        };
    });
});

const initialAnswers = computed(() =>
    props.questions.map((question) => {
        return {
            question_id: question.id,
            answer_id: null,
        };
    })
);

const createSession = () => {
    router.post(route("sessions.store"), {
        answers: answers.value,
        difficulty: difficulty.value,
    });
};

const submit = () => {
    if (isSessionStarted.value) {
        createSession();
    } else {
        startSession();
    }
};
</script>

<template>
    <GuestLayout>
        <Head title="Create answer" />

        {{ answers }}

        <form v-if="isSessionStarted" @submit.prevent="submit">
            <ul>
                'ses'
                <li
                    v-for="(question, index) in questionsWithRandomAnswersOrder"
                    :key="question.id"
                >
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

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4"> Create </PrimaryButton>
            </div>
        </form>

        <form v-else @submit.prevent="submit">
            <div>
                <InputLabel for="difficulty" value="Difficulty" />

                <TextInput
                    id="difficulty"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="difficulty"
                    required
                    autofocus
                    autocomplete="difficulty"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4"> Start </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
