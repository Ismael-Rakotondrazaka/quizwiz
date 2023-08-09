<template>
    <Link
        class="inline-flex items-center px-4 py-2 font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-sky-800 hover:bg-sky-700 focus:bg-sky-700 active:bg-sky-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
