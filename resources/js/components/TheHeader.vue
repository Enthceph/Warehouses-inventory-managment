<script lang="ts" setup>
import TheUserBadge from "@/js/components/TheUserBadge.vue";
import { useWarehousesStore } from "@/js/stores/warehouses";

const route = useRoute()
const warehouseStore = useWarehousesStore()
</script>

<template>
    <header class="header">
        <TheUserBadge />

        <h2 class="text-h6 font-bold h2">
            <span>{{ route.name }}</span>
            <span v-if="route.name === 'Warehouse' && warehouseStore.selectedWarehouse">: {{
                warehouseStore.selectedWarehouse.name
            }}</span>
        </h2>

        <router-link class="ml-auto" to="/settings">
            <q-icon name="miscellaneous_services" />
        </router-link>
    </header>
</template>

<style scoped>
header {
    align-items: center;
    background-color: #1C77FB;
    color: white;
    display: flex;
    gap: 12px;
    justify-content: flex-start;
    padding: 16px 16px 16px 0;
}

.h2 {
    font-size: 30px;
    font-weight: 800;
}
</style>
