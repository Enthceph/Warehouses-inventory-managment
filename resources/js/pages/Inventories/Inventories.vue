<script lang="ts" setup>
import {useInventoriesStore} from "@/js/stores/inventories";
import Table from "@/js/components/Table/Table.vue";

const inventoriesStore = useInventoriesStore()

onMounted(async () => {
    await inventoriesStore.fetchGetInventories()

    console.log(inventoriesStore.inventories)
})

const columnNames = [
    'id',
    'Назва продукту',
    'Кількість',
    'Ціна за одиницю',
    'Загальна вартість',
    'Склад',
    'Знаходится на складі з',
    'Термін придатності(Якщо є)',
]

const tableData = computed(() => {
    return inventoriesStore.inventories.map((inventory) => {
        return {
            id: inventory.id,
            product: inventory.product.name,
            quantity: inventory.quantity,
            unit_price: inventory.unit_price,
            total_value: inventory.total_value,
            warehouse: inventory.warehouse.name,
            created_at: new Date(inventory.created_at).toLocaleDateString('ru-RU'),
            expires_at: inventory.expires_at !== null ? new Date(inventory.expires_at).toLocaleDateString('ru-RU') : null,
        }
    })
})

</script>

<template>
    <Table
        :column-names="columnNames"
        :data="tableData"
    />

    <!--    {{ inventoriesStore.inventories }}-->
</template>

<style scoped>

</style>
