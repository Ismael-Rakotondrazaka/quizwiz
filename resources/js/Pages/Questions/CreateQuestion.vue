<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    content: "",
    difficulty: "medium",
});

const submit = () => {
    form.post(route("questions.store"), {});
};
</script>

<template>
    <GuestLayout>
        <Head title="Create question" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="content" value="Content" />

                <TextInput
                    id="content"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.content"
                    required
                    autofocus
                    autocomplete="content"
                />

                <InputError class="mt-2" :message="form.errors.content" />
            </div>

            <div>
                <InputLabel for="difficulty" value="Difficulty" />

                <TextInput
                    id="difficulty"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.difficulty"
                    required
                    autofocus
                    autocomplete="difficulty"
                />

                <InputError class="mt-2" :message="form.errors.difficulty" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Create
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
