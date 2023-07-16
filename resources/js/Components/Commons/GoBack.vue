<template>
    <button
        @click="goBack"
        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-black uppercase transition duration-150 ease-in-out bg-gray-300 border border-transparent rounded-md hover:bg-gray-400 focus:bg-gray-500 active:bg-gray-500 focus:outline-none"
    >
        <fa-icon icon="fa-solid fa-arrow-left" />
    </button>
</template>

<script setup>
const goBack = () => {
    if (window.history.length > 1) {
        window.history.back();
    }
};
</script>

<style scoped></style>
