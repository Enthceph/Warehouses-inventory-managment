<script lang="ts" setup>
import {useWarehousesStore} from "@/js/stores/warehouses";
import AddWarehouseForm from "@/js/components/Forms/Warehouse/AddWarehouseForm.vue";
import Table from "@/js/components/Table/Table.vue";
import EditWarehouseForm from "@/js/components/Forms/Warehouse/EditWarehouseForm.vue";
import DeleteWarehouseForm from "@/js/components/Forms/Warehouse/DeleteWarehouseForm.vue";
import {useAuthStore} from "@/js/stores/auth";

const router = useRouter()
const route = useRoute()
const warehouseStore = useWarehousesStore()
const authStore = useAuthStore()

onMounted(async () => {
    await warehouseStore.fetchGetWarehouses()
})

const columnNames = [
    'id',
    'Name',
    'Contact info',
    'Location',
    'Created',
]

const tableData = computed(() => {
    return warehouseStore.warehouses.map((warehouse) => {
        return {
            id: warehouse.id,
            name: warehouse.name,
            contact_info: warehouse.contact_info,
            location: warehouse.location,
            created_at: warehouse.created_at ? new Date(warehouse.created_at).toLocaleDateString('ru-RU') : null,
        }
    })
})
</script>

<template>
    <Table
        :column-names="columnNames"
        :columns="tableData"
        :data="warehouseStore.warehouses"
        :hide-action-buttons="authStore.role !== 'Owner'"
    >
        <template v-slot:addForm="{submit, cancel}" #addForm>
            <AddWarehouseForm @cancel="cancel" @submit="submit"/>
        </template>

        <template v-slot:editForm="{submit, cancel, selected}" #editForm>
            <EditWarehouseForm :warehouse="selected" @cancel="cancel" @submit="submit"/>
        </template>

        <template v-slot:deleteForm="{submit, cancel , selected}" #deleteForm>
            <DeleteWarehouseForm :warehouse="selected" @cancel="cancel" @submit="submit"/>
        </template>
    </Table>

</template>
