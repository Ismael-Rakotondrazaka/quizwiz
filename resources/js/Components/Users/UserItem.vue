<template>
    <tr :class="[background]">
        <td class="px-4 py-3 text-gray-600 border-b">{{ user.id }}</td>

        <td class="px-4 py-3 border-b">{{ user.last_name }}</td>

        <td class="px-4 py-3 border-b">{{ user.first_name }}</td>

        <td class="px-4 py-3 border-b">{{ user.email }}</td>

        <td class="px-4 py-3 text-blue-700 border-b">
            {{ createdAtFormatted }}
        </td>

        <td class="px-4 py-3 text-center border-b">
            <Link :href="route('users.show', [user.id])">
                <fa-icon
                    icon="fa-solid fa-arrow-up-right-from-square"
                    class="text-3xl text-sky-400"
                />
                <span class="sr-only">Open</span>
            </Link>
        </td>
    </tr>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { useDateFormat } from "@vueuse/core";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    rank: {
        type: Number,
        required: false,
        default: 0,
    },
});

const background = computed(() =>
    props.rank % 2 ? "bg-slate-50" : "bg-slate-200"
);

const createdAtFormatted = useDateFormat(props.user.created_at, "MMM D, YYYY");
</script>

<style scoped></style>
