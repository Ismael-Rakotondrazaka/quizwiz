<template>
    <div class="">
        <img
            src="@/assets/images/abstract_curve.svg"
            alt=""
            class="absolute top-0 right-0 left-1/3 -z-10"
        />

        <header
            class="container flex items-center justify-between px-4 pt-2 mx-auto sm:px-6 lg:px-8 sm:pt-4 lg:pt-8"
        >
            <div>QuizWiz</div>

            <nav>
                <ul class="flex items-center justify-between gap-10">
                    <li>
                        <NavLink routeName="home">Home</NavLink>
                    </li>
                    <li>
                        <NavLink routeName="dashboard">Dashboard</NavLink>
                    </li>
                    <li>
                        <NavLink routeName="profile.edit">Profile</NavLink>
                    </li>
                    <li v-if="isAdmin">
                        <NavLink routeName="admin.dashboard">Admin</NavLink>
                    </li>
                    <li>
                        <NavLink routeName="about">About</NavLink>
                    </li>
                    <li>
                        <NavLink routeName="logout" method="post" as="button"
                            >Logout</NavLink
                        >
                    </li>
                </ul>
            </nav>
        </header>

        <slot />

        <TheFooter :isAuthenticated="isAuthenticated" />
    </div>
</template>

<script setup>
import NavLink from "@/Components/Header/NavLink.vue";
import TheFooter from "@/Components/Footer/TheFooter.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();

const isAdmin = computed(() => page.props.auth.user.role === "admin");

const isAuthenticated = computed(() => !!page.props.auth.user);
</script>

<style scoped></style>
