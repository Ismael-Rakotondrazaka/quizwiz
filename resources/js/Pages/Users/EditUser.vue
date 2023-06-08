<template>
    <form @submit.prevent="submit">
        <div>
            <InputLabel for="first_name" value="FirstName" />

            <TextInput
                id="first_name"
                type="text"
                class="block w-full mt-1"
                v-model="form.first_name"
                required
                autofocus
                autocomplete="first_name"
            />

            <InputError class="mt-2" :message="form.errors.first_name" />
        </div>

        <div>
            <InputLabel for="last_name" value="LastName" />

            <TextInput
                id="last_name"
                type="text"
                class="block w-full mt-1"
                v-model="form.last_name"
                required
                autofocus
                autocomplete="last_name"
            />

            <InputError class="mt-2" :message="form.errors.last_name" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Update
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
});

const submit = () => {
    form.put(route("users.update", props.user.id), {});
};
</script>

<style scoped></style>
