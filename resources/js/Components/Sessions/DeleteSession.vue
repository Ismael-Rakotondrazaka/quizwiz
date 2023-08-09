<template>
    <VDropdown
        :positioning-disabled="true"
        @apply-show="toggleDeleteSession"
        @apply-hide="toggleDeleteSession"
    >
        <button>
            <fa-icon
                icon="fa-solid fa-trash-can"
                class="text-3xl text-red-400"
            />
            <span class="sr-only">Delete</span>
        </button>

        <template #popper="{ hide }">
            <div class="px-3 bg-red-400 py-7">
                <fa-icon
                    icon="fa-icon fa-exclamation-triangle"
                    class="block mx-auto text-6xl text-white"
                />
            </div>

            <div class="w-full max-w-md p-3 text-center">
                <h2 class="text-2xl font-bold text-red-500">
                    Delete the session ?
                </h2>

                <p class="text-lg">The session will be deleted.</p>

                <p class="text-lg">
                    This action is
                    <span class="font-bold text-red-400 underline"
                        >irreversible</span
                    >.
                </p>

                <div
                    class="flex items-center justify-center w-full mt-5 gap-x-5"
                >
                    <DangerButton
                        @click="destroySession"
                        class="block px-4 py-2 tracking-widest text-white uppercase bg-red-400 rounded-full leading-2"
                    >
                        Yes, delete
                    </DangerButton>

                    <SecondaryButton
                        @click="hide"
                        class="block px-4 py-2 tracking-widest uppercase rounded-full bg-slate-300 leading-2"
                    >
                        Cancel
                    </SecondaryButton>
                </div>
            </div>
        </template>
    </VDropdown>
</template>

<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    session: {
        type: Object,
        required: true,
    },
});

const isDeleteSessionOpened = ref(false);

const toggleDeleteSession = () => {
    if (isDeleteSessionOpened.value) {
        document.body.classList.remove("no-scroll");
    } else {
        document.body.classList.add("no-scroll");
    }
    isDeleteSessionOpened.value = !isDeleteSessionOpened.value;
};

const form = useForm({});

const destroySession = () => {
    form.delete(
        route("sessions.destroy", [props.session.user_id, props.session.id])
    );
};
</script>

<style scoped></style>
