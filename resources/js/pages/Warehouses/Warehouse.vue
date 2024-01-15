<script lang="ts" setup>
import {useWarehousesStore} from "@/js/stores/warehouses";
import {Inventory} from "@/js/types/inventory.types";

const route = useRoute()
const warehouseStore = useWarehousesStore()
const warehouse = ref({})
const inventory = ref<Inventory[]>([])

onMounted(async () => {
    warehouse.value = await warehouseStore.fetchGetWarehouse(Number(route.params.warehouse))
    inventory.value = await warehouseStore.fetchGetWarehouseInventory(Number(route.params.warehouse))
})
</script>

<template>
    <div>{{ warehouse }}</div>
    <br>
    <div>{{ inventory }}</div>
</template>
