<template>
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="w-full p-8 bg-white border rounded-lg shadow-lg border-sky-400 md:w-1/2 lg:w-2/3"
        >
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-7">
                Users:
            </h1>

            <table class="min-w-full mt-1 bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b max-w-[15px]">Id</th>
                        <th class="px-4 py-2 border-b">First name</th>
                        <th class="px-4 py-2 border-b">Name</th>
                        <th class="px-4 py-2 border-b">Email</th>
                        <th class="px-4 py-2 border-b">Member since</th>
                        <th class="px-4 py-2 border-b">Open</th>
                    </tr>
                </thead>
                <tbody>
                    <UserItem
                        v-for="(user, index) in users"
                        :key="user.id"
                        :rank="index"
                        :user="user"
                    />
                </tbody>
            </table>

            <PaginationLinkList
                :paginationLinks="paginationLinks"
                class="mt-7"
            />
        </div>
    </div>
</template>

<script setup>
import UserItem from "@/Components/Users/UserItem.vue";
import PaginationLinkList from "@/Components/Commons/PaginationLinkList.vue";

const props = defineProps({
    users: {
        type: Array,
        required: false,
        default: () => [],
    },
    paginationLinks: {
        type: Object,
        required: true,
    },
});
</script>

<style scoped></style>
