<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, router } from "@inertiajs/vue3";
import { defineProps, computed, ref, watch } from "@vue/runtime-core";
import CustomRadioButton from "@/Components/Commons/CustomRadioButton.vue";
import CustomStepper from "@/Components/Commons/CustomStepper.vue";

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

const steps = computed(() => props.questions.map((_, i) => i + 1));

const currentStep = ref(0);

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
    <!-- <GuestLayout> -->
    <Head title="Create answer" />

    {{ answers }}

    <CustomStepper :steps="steps" :currentStep="currentStep" />

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
                        <CustomRadioButton
                            :for="'answer_' + answer.id"
                            :value="answer.id"
                            :badge="index2 + 1 + ''"
                            :modelValue="answers[index]['answer_id']"
                            @onValueChanged="
                                (newValue) => {
                                    console.log(newValue);

                                    answers[index]['answer_id'] = +newValue;
                                }
                            "
                        >
                            {{ answer.content }}
                        </CustomRadioButton>
                        <!-- <label :for="'answer_' + answer.id">
                                <input
                                    type="radio"
                                    :value="answer.id"
                                    v-model="answers[index]['answer_id']"
                                    :id="'answer_' + answer.id"
                                />
                                {{ index2 }}. {{ answer.content }}
                            </label> -->
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
    <!-- </GuestLayout> -->
</template>
