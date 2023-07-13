<template>
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-1/3"
        >
            <form @submit.prevent="startSession">
                <div>
                    <InputLabel for="difficulty" value="Difficulty" />

                    <select
                        v-model="difficulty"
                        class="block w-full px-4 py-2 pr-8 mt-1 bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-primary focus:border-primary-dark"
                        id="difficulty"
                        required
                    >
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
                </div>

                <div class="flex items-center justify-end mt-9">
                    <PrimaryButton class="ml-4"> Start </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import PrimaryButton from "../PrimaryButton.vue";
import InputLabel from "../InputLabel.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    difficulty: {
        type: String,
        required: true,
    },
    questions: {
        type: Array,
        required: false,
        default: () => [],
    },
});

const difficulty = ref("easy");

const startSession = () => {
    router.post(route("sessions.start"), {
        difficulty: difficulty.value,
    });
};
</script>

<style scoped></style>
