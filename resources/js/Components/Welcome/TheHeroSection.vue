<template>
    <main
        class="relative min-h-[100vh] flex items-center justify-around flex-wrap-reverse ld:flex-no-wrap"
    >
        <img
            src="@/assets/images/illustration_question.svg"
            alt=""
            class="w-[90%] max-w-xl lg:w-1/3"
        />
        <div class="flex items-center justify-center">
            <div class="w-full mx-auto my-10 md:w-fit lg:my-0">
                <h1
                    id=""
                    class="text-4xl font-bold text-white md:text-6xl mb-7 lg:mb-16 xl:text-7xl text-shadow"
                >
                    Test Your Coding<br /><span id="typing" />
                </h1>
                <Link
                    :href="href"
                    class="px-5 py-2 text-white uppercase border-2 rounded-full md:px-7 md:py-3 lg:px-10 lg:py-4 text-md lg:text-3xl bg-sky-800/80 fond-bold"
                >
                    Start now
                </Link>
            </div>
        </div>
    </main>
</template>

<script setup>
import Typed from "typed.js";
import { onMounted, ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";

const typed = ref(null);

onMounted(() => {
    typed.value = new Typed("#typing", {
        strings: ["Superpowers", "Skills"],
        typeSpeed: 100,
        loop: true,
        loopCount: Infinity,
        smartBackspace: false,
        backSpeed: 80,
        backDelay: 1000,
    });
});

const props = defineProps({
    isAuthenticated: {
        type: Boolean,
        required: false,
        default: false,
    },
});

const href = computed(() =>
    props.isAuthenticated ? route("dashboard") : route("login")
);
</script>

<style scoped>
.text-shadow {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}
</style>
