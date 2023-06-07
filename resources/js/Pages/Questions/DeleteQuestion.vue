<template>
    <div>
        <pre><code>{{ question }}</code></pre>
        <Link :href="route('questions.show', question.id)">Cancel</Link>
    </div>

    <form @submit.prevent="submit">
        {{ form.errors }}

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Delete
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
});

const form = useForm({});

const submit = () => {
    form.delete(route("questions.destroy", props.question.id), {});
};
</script>

<style scoped></style>
