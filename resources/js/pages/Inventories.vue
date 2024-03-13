<script lang="ts" setup>
import { useInventoriesStore } from "@/js/stores/inventories";
import Table from "@/js/components/Table/Table.vue";
import { Warehouse } from "@/js/types/warehouse.types";
import AddInventoryForm from "@/js/components/Forms/Inventory/AddInventoryForm.vue";
import DeleteInventoryForm from "@/js/components/Forms/Inventory/DeleteInventoryForm.vue";
import UpdateInventoryForm from "../components/Forms/Inventory/UpdateInventoryForm.vue";

const inventoriesStore = useInventoriesStore()

onMounted(async () => {
    await inventoriesStore.fetchGetInventories()
})

const columnNames = [
    'id',
    'Product',
    'Quantity',
    'Unit price',
    'The total cost',
    'Warehouse',
    'In stock since',
    'Expiry Date',
]

const columns = computed(() => {
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
    <Table :column-names="columnNames" :columns="columns" :data="inventoriesStore.inventories">
        <template v-slot:addForm="{ submit, cancel }" #addForm>
            <AddInventoryForm @cancel="cancel" @submit="submit" />
        </template>

        <template v-slot:updateForm="{ submit, cancel, selected }" #updateForm>
            <UpdateInventoryForm :inventory="selected" @cancel="cancel" @submit="submit" />
        </template>

        <template v-slot:deleteForm="{ submit, cancel, selected }" #deleteForm>
            <DeleteInventoryForm :inventory="selected" @cancel="cancel" @submit="submit" />
        </template>
    </Table>
</template>
