<template>
    <VDropdown
        :triggers="[]"
        :auto-hide="false"
        :shown="shown"
        :positioning-disabled="true"
    >
        <template #popper="{ hide }">
            <div
                class="flex flex-row items-center justify-center px-3 bg-sky-400 py-7 gap-x-4"
            >
                <fa-icon
                    icon="fa-icon fa-star"
                    class="block text-6xl translate-y-1"
                    :class="{
                        'text-yellow-400': stars >= 1,
                        'text-gray-200': stars < 1,
                    }"
                />
                <fa-icon
                    icon="fa-icon fa-star"
                    class="block text-6xl -translate-y-2"
                    :class="{
                        'text-yellow-400': stars >= 2,
                        'text-gray-200': stars < 2,
                    }"
                />
                <fa-icon
                    icon="fa-icon fa-star"
                    class="block text-6xl translate-y-1"
                    :class="{
                        'text-yellow-400': stars >= 3,
                        'text-gray-200': stars < 3,
                    }"
                />
            </div>

            <Particles
                v-if="isSuccess"
                id="tsparticles"
                :particlesInit="particlesInit"
                :options="confettis"
            />

            <div class="w-full max-w-md p-3 text-center">
                <h2 class="text-2xl font-bold text-sky-500">
                    {{ title }}
                </h2>

                <p class="text-lg">
                    {{ message }}
                </p>

                <div
                    class="flex items-center justify-center w-full mt-5 gap-x-5"
                >
                    <button
                        @click="hide"
                        class="block px-4 py-2 tracking-widest uppercase rounded-full bg-sky-300 leading-2"
                    >
                        Close
                    </button>
                </div>
            </div>
        </template>
    </VDropdown>
</template>

<script setup>
import { loadFull } from "tsparticles";
import { computed } from "vue";
import { confettis } from "@/Utils/TsParticles/confettis.js";

const props = defineProps({
    stars: {
        type: Number,
        required: false,
        default: 0,
    },
    shown: {
        type: Boolean,
        required: false,
        default: false,
    },
});

const isSuccess = computed(() => props.stars > 0);

const particlesInit = async (engine) => {
    await loadFull(engine);
};

const title = computed(() =>
    props.stars > 0 ? "Congratulations" : "You can do better !"
);

const message = computed(() =>
    props.stars > 0
        ? `You've got ${props.stars} star${props.stars > 1 ? "s" : ""}`
        : "You've got no stars"
);
</script>

<style scoped></style>
