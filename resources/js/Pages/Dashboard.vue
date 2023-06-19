<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CustomButton from "@/Components/Commons/CustomButton.vue";
import { Head } from '@inertiajs/vue3';
import CustomRadioButton from "@/Components/Commons/CustomRadioButton.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>

        <CustomButton>Nextezuyt

            <template v-slot:badge>10</template>
        </CustomButton>
    </AuthenticatedLayout>
</template>
