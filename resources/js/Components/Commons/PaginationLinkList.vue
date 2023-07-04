<template>
    <div>
        <ul class="flex items-center justify-center gap-3">
            <PaginationLinkItem
                v-for="(paginationLink, index) in paginationLinks"
                :key="index"
                :paginationLink="paginationLink"
            />
        </ul>
    </div>
</template>

<script setup>
import PaginationLinkItem from "@/Components/Commons/PaginationLinkItem.vue";

const props = defineProps({
    paginationLinks: {
        type: Object,
        required: true,
    },
});
</script>

<style scoped></style>
