<template>
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-1/3"
        >
            <form @submit.prevent="submit">
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                    Edit user
                </h1>

                <div>
                    <InputLabel for="first_name" value="First name" />

                    <TextInput
                        id="first_name"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.first_name"
                        required
                        autofocus
                        autocomplete="first_name"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.first_name"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="last_name" value="Last name" />

                    <TextInput
                        id="last_name"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.last_name"
                        required
                        autocomplete="last_name"
                    />

                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link
                        :href="route('users.show', [user.id])"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-black uppercase transition duration-150 ease-in-out bg-gray-300 border border-transparent rounded-md hover:bg-gray-400 focus:bg-gray-500 active:bg-gray-500 focus:outline-none"
                    >
                        Cancel
                    </Link>

                    <PrimaryButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Update
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, Link } from "@inertiajs/vue3";

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
