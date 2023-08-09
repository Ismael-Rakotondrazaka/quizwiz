<template>
    <section class="flex items-center justify-center min-h-screen px-8 py-16">
        <div class="container mx-auto">
            <h2 class="mb-8 text-3xl font-bold text-center">
                What QuizWiz Users Say
            </h2>
            <div
                class="grid grid-cols-1 gap-8 justify-items-center md:grid-cols-2 lg:grid-cols-2"
            >
                <CustomCard class="max-w-md">
                    <p class="text-gray-700">
                        "QuizWiz has been an invaluable resource in my Vue.js
                        learning journey. The quizzes are both challenging and
                        rewarding, helping me grow as a developer."
                    </p>
                    <p class="mt-4 font-bold text-gray-800">- Happy Learner</p>
                </CustomCard>
                <CustomCard class="max-w-md">
                    <p class="text-gray-700">
                        "I love how QuizWiz allows me to create personalized
                        sessions. It's like having a study partner that caters
                        to my individual needs."
                    </p>
                    <p class="mt-4 font-bold text-gray-800">- Satisfied User</p>
                </CustomCard>
            </div>
        </div>
    </section>
</template>

<script setup>
import CustomCard from "../Commons/CustomCard.vue";
</script>

<style scoped></style>
