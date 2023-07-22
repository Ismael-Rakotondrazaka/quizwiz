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
                        <NavLink routeName="login">Sign in</NavLink>
                    </li>
                    <li>
                        <NavLink routeName="register">Register</NavLink>
                    </li>
                    <li>
                        <NavLink routeName="about">About</NavLink>
                    </li>
                </ul>
            </nav>
        </header>

        <slot />

        <TheFooter />
    </div>
</template>

<script setup>
import TheFooter from "@/Components/Footer/TheFooter.vue";
import NavLink from "@/Components/Header/NavLink.vue";
</script>

<style scoped></style>
