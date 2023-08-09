<template>
    <div class="flex items-center justify-center min-h-screen">
        <CustomCard class="w-full md:w-1/2 lg:w-1/2">
            <div class="">
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                    User {{ user.id }}:
                </h1>

                <div class="flex gap-x-5">
                    <div class="w-full mb-3">
                        <InputLabel for="first_name" value="First name" />

                        <input
                            type="text"
                            id="first_name"
                            class="w-full p-2 mt-1 border border-gray-300 rounded-md"
                            :value="user.first_name"
                            disabled
                        />
                    </div>

                    <div class="w-full mb-3">
                        <InputLabel for="last_name" value="Last name" />

                        <input
                            type="text"
                            id="last_name"
                            class="w-full p-2 mt-1 border border-gray-300 rounded-md"
                            :value="user.last_name"
                            disabled
                        />
                    </div>
                </div>

                <div class="mb-3">
                    <InputLabel for="email" value="Email" />

                    <input
                        type="text"
                        id="email"
                        class="w-full p-2 mt-1 border border-gray-300 rounded-md"
                        :value="user.email"
                        disabled
                    />
                </div>

                <div class="mb-3">
                    <InputLabel for="created_at" value="Member since" />

                    <input
                        type="text"
                        id="created_at"
                        class="w-full p-2 mt-1 text-blue-700 border border-gray-300 rounded-md"
                        :value="userCreatedAtFormatted"
                        disabled
                    />
                </div>

                <div class="flex items-center justify-end mt-4 gap-x-7">
                    <DeleteUser :user="user" />

                    <PrimaryLink
                        :href="route('users.edit', [user.id])"
                        class=""
                    >
                        <fa-icon icon="fa-icon fa-pen-to-square" class="mr-2" />
                        Edit
                    </PrimaryLink>
                </div>
            </div>

            <hr class="my-10 border-t-2" />

            <div>
                <div class="mt-4">
                    <InputLabel for="sessions" value="Sessions" />

                    <SessionList :sessions="sessions" />
                </div>

                <PaginationLinkList
                    :paginationLinks="paginationLinks"
                    class="mt-7"
                />
            </div>
        </CustomCard>
    </div>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import DeleteUser from "@/Components/Users/DeleteUser.vue";
import PrimaryLink from "@/Components/Links/PrimaryLink.vue";
import PaginationLinkList from "@/Components/Commons/PaginationLinkList.vue";
import { useDateFormat } from "@vueuse/core";
import SessionList from "@/Components/Sessions/SessionList.vue";
import CustomCard from "../Commons/CustomCard.vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    sessions: {
        type: Array,
        required: false,
        default: () => [],
    },
    paginationLinks: {
        type: Object,
        required: true,
    },
});

const userCreatedAtFormatted = useDateFormat(
    props.user.created_at,
    "MMM D, YYYY"
);
</script>

<style></style>
