<template>
    <VDropdown
        :positioning-disabled="true"
        @apply-show="toggleDeleteUser"
        @apply-hide="toggleDeleteUser"
    >
        <DangerButton class="inline-block">
            <fa-icon icon="fa-icon fa-trash-can" class="mr-2" />
            Delete
        </DangerButton>

        <template #popper="{ hide }">
            <div class="px-3 bg-red-400 py-7">
                <fa-icon
                    icon="fa-icon fa-exclamation-triangle"
                    class="block mx-auto text-6xl text-white"
                />
            </div>
            <div class="w-full max-w-md p-3 text-center">
                <h2 class="text-2xl font-bold text-red-500">
                    Delete the user ?
                </h2>
                <p class="text-lg">
                    The user and its sessions will be deleted.
                </p>
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
                        @click="destroyUser"
                        class=""
                    >
                        Yes, delete
                    </DangerButton>

                    <SecondaryButton
                        @click="hide"
                        class=""
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
    user: {
        type: Object,
        required: true,
    },
});

const isDeleteUserOpened = ref(false);

const toggleDeleteUser = () => {
    if (isDeleteUserOpened.value) {
        document.body.classList.remove("no-scroll");
    } else {
        document.body.classList.add("no-scroll");
    }

    isDeleteUserOpened.value = !isDeleteUserOpened.value;
};

const form = useForm({});

const destroyUser = () => {
    form.delete(route("users.destroy", [props.user.id]));
};
</script>

<style></style>
