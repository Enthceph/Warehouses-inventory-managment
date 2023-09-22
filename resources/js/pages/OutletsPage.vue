<script setup lang="ts">
import OrgCard from "@/js/components/OrgCard.vue";
import OrgAddCard from "@/js/components/OrgAddCard.vue";

const cards = [
    {
        title: "Outlet 1",
        address: "St. of saint louis ",
        contact_info: "+380501112345",
    },
    {
        title: "Outlet 2",
        address: "St. of saint louis ",
        contact_info: "+380501112345",
    },
]
</script>

<template>
    <div class="grid">
        <org-card v-for="card of cards" :key="card.title" :title="card.title" :address="card.address"
            :contact_info="card.contact_info" />
        <org-add-card />
    </div>
</template>

<style scoped>
.grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    grid-template-rows: repeat(5, 1fr);
    grid-column-gap: 32px;
    grid-row-gap: 32px;
    cursor: pointer;
}
</style>
