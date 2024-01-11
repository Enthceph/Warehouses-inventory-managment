<script lang="ts" setup>
import {Inventory, useWarehouseStore} from "@/js/stores/warehouses";

const route = useRoute()
const warehouseStore = useWarehouseStore()
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
