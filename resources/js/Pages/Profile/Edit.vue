<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Profile
            </h2>
        </template>

        <div class="py-12">
            <div
                class="w-full mx-auto space-y-6 sm:px-6 lg:px-8 md:w-1/2 lg:w-1/2"
            >
                <div
                    class="p-4 bg-white border shadow-lg sm:p-8 border-sky-400 sm:rounded-lg"
                >
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class=""
                    />
                </div>

                <div
                    class="p-4 bg-white border shadow-lg sm:p-8 border-sky-400 sm:rounded-lg"
                >
                    <UpdatePasswordForm class="" />
                </div>

                <div
                    class="p-4 bg-white border shadow-lg sm:p-8 border-sky-400 sm:rounded-lg"
                >
                    <DeleteUserForm class="" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
