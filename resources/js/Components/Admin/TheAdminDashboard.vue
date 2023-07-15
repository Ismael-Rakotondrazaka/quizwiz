<template>
    <div class="flex items-center min-h-screen justify-evenly">
        <div
            class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-2/3"
        >
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                Dashboard:
            </h1>

            <div class="flex items-stretch justify-evenly">
                <div
                    class="min-w-[20rem] py-5 px-7 bg-sky-700 text-white rounded-lg"
                >
                    <h1 class="text-5xl text-center">Users</h1>

                    <p class="my-5 text-6xl font-bold text-center">
                        {{ userCount }}
                    </p>

                    <Link
                        :href="route('users.index')"
                        class="block text-lg font-bold text-center"
                        >Show</Link
                    >
                </div>

                <div
                    class="min-w-[20rem] py-5 px-7 bg-sky-700 text-white rounded-lg"
                >
                    <h1 class="text-5xl text-center">Sessions</h1>

                    <p class="my-5 text-6xl font-bold text-center">
                        {{ sessionCount }}
                    </p>
                </div>

                <div
                    class="min-w-[20rem] py-5 px-7 bg-sky-700 text-white rounded-lg"
                >
                    <h1 class="text-5xl text-center">Questions</h1>

                    <p class="my-5 text-6xl font-bold text-center">
                        {{ questionCount }}
                    </p>

                    <Link
                        :href="route('questions.index')"
                        class="block text-lg font-bold text-center"
                        >Show</Link
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    userCount: {
        type: Number,
        required: false,
        default: 0,
    },
    questionCount: {
        type: Number,
        required: false,
        default: 0,
    },
    sessionCount: {
        type: Number,
        required: false,
        default: 0,
    },
});
</script>

<style scoped></style>
