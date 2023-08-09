<script setup>
import CustomCard from "@/Components/Commons/CustomCard.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => toggleDeleteAccount(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const isDeleteAccountOpened = ref(false);

const toggleDeleteAccount = () => {
    if (isDeleteAccountOpened.value) {
        document.body.classList.remove("no-scroll");
        form.reset();
    } else {
        document.body.classList.add("no-scroll");
        nextTick(() => passwordInput.value.focus());
    }
    isDeleteAccountOpened.value = !isDeleteAccountOpened.value;
};
</script>

<template>
    <CustomCard>
        <section class="space-y-6">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    Delete Account
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data
                    will be permanently deleted. Before deleting your account,
                    please download any data or information that you wish to
                    retain.
                </p>
            </header>

            <VDropdown
                :positioning-disabled="true"
                @apply-show="toggleDeleteAccount"
                @apply-hide="toggleDeleteAccount"
            >
                <div class="flex items-center justify-end gap-4">
                    <DangerButton>Delete Account</DangerButton>
                </div>

                <template #popper="{ hide }">
                    <div class="px-3 bg-red-400 py-7">
                        <fa-icon
                            icon="fa-icon fa-exclamation-triangle"
                            class="block mx-auto text-6xl text-white"
                        />
                    </div>

                    <div class="w-full max-w-md p-3 text-center">
                        <h2 class="text-2xl font-bold text-red-500">
                            Are you sure you want to delete your account?
                        </h2>

                        <p class="text-lg">
                            Once your account is deleted, all of its resources
                            and data will be permanently deleted. Please enter
                            your password to confirm you would like to
                            permanently delete your account.
                        </p>

                        <div class="mt-6">
                            <InputLabel
                                for="password"
                                value="Password"
                                class="sr-only"
                            />

                            <TextInput
                                id="password"
                                ref="passwordInput"
                                v-model="form.password"
                                type="password"
                                class="block w-full mt-1"
                                placeholder="Password"
                                @keyup.enter="deleteUser"
                            />

                            <InputError
                                :message="form.errors.password"
                                class="mt-2 text-left"
                            />
                        </div>

                        <div
                            class="flex items-center justify-center w-full mt-5 gap-x-5"
                        >
                            <DangerButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                class=""
                                @click="deleteUser"
                            >
                                Yes, delete
                            </DangerButton>

                            <SecondaryButton @click="hide" class="">
                                Cancel
                            </SecondaryButton>
                        </div>
                    </div>
                </template>
            </VDropdown>
        </section>
    </CustomCard>
</template>
