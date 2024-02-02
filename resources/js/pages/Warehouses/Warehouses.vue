<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import {useWarehousesStore} from "@/js/stores/warehouses";
import AddWarehouseForm from "@/js/components/Forms/Warehouse/AddWarehouseForm.vue";
import Table from "@/js/components/Table/Table.vue";
import EditWarehouseForm from "@/js/components/Forms/Warehouse/EditWarehouseForm.vue";
import DeleteWarehouseForm from "@/js/components/Forms/Warehouse/DeleteWarehouseForm.vue";
import {Warehouse} from "@/js/types/warehouse.types";

defineEmits([...useDialogPluginComponent.emits]);
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const router = useRouter()
const route = useRoute()
const warehouseStore = useWarehousesStore()

const showAddWarehouseModal = ref(false)
const showEditWarehouseModal = ref(false)
const showDeleteWarehouseModal = ref(false)

onMounted(async () => {
    await warehouseStore.fetchGetWarehouses()

    console.log(warehouseStore.warehouses)
})

// TABLE EMITS
const onRowAdd = () => {
    showAddWarehouseModal.value = true
}

const onRowEdit = (row: Warehouse) => {
    warehouseStore.selectedWarehouse = row
    showEditWarehouseModal.value = true
}

const onRowDelete = (row: Warehouse) => {
    warehouseStore.selectedWarehouse = row
    showDeleteWarehouseModal.value = true
}

const onRowClicked = (row: Warehouse) => {
    router.push(`/warehouses/${row.id}`)
}

const columnNames = [
    'id',
    'Назва',
    'Контактна інформація',
    'Місцезнаходження',
    'Був створений',
]

const tableData = computed(() => {
    return warehouseStore.warehouses.map((warehouse) => {
        return {
            id: warehouse.id,
            name: warehouse.name,
            contact_info: warehouse.contact_info,
            location: warehouse.location,
            created_at: new Date(warehouse.created_at).toLocaleDateString('ru-RU'),
        }
    })
})
</script>

<template>
    <Table
        :column-names="columnNames"
        :data="tableData"
        @rowAdd="onRowAdd"
        @rowClicked="onRowClicked"
        @rowDelete="onRowDelete"
        @rowEdit="onRowEdit"
    />

    <!--    MODALS    -->

    <q-dialog ref="dialogRef" v-model="showAddWarehouseModal" @hide="onDialogHide">
        <AddWarehouseForm
            @cancel="showAddWarehouseModal = false"
            @submitted="showAddWarehouseModal = false"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showEditWarehouseModal" @hide="onDialogHide">
        <EditWarehouseForm
            @cancel="showEditWarehouseModal = false"
            @submitted="showEditWarehouseModal = false"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showDeleteWarehouseModal" @hide="onDialogHide">
        <DeleteWarehouseForm
            @cancel="showDeleteWarehouseModal = false"
            @submitted="showDeleteWarehouseModal = false"
        />
    </q-dialog>
</template>
