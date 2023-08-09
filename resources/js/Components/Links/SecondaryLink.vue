<template>
    <Link
        class="inline-flex items-center px-4 py-2 font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-gray-200 border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
