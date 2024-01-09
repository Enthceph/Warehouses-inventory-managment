<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import {useWarehouseStore, Warehouse} from "@/js/stores/warehouses";
import AddWarehouseForm from "@/js/components/Forms/Warehouse/AddWarehouseForm.vue";
import Table from "@/js/components/Table/Table.vue";
import EditWarehouseForm from "@/js/components/Forms/Warehouse/EditWarehouseForm.vue";
import DeleteWarehouseForm from "@/js/components/Forms/Warehouse/DeleteWarehouseForm.vue";

defineEmits([...useDialogPluginComponent.emits]);
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const warehouseStore = useWarehouseStore()
const selectedRow = ref({})

onMounted(() => {
    warehouseStore.fetchGetWarehouses()
})


// Get Warehouse

// Add Warehouse
const showAddWarehouseModal = ref(false)
const fetchAddWarehouse = async (warehouses: Warehouse) => {
    await warehouseStore.fetchAddWarehouse(warehouses)
    await warehouseStore.fetchGetWarehouses()
    showAddWarehouseModal.value = false
}

// Edit Warehouse
const showEditWarehouseModal = ref(false)
const fetchEditWarehouse = async (warehouse: Warehouse) => {
    await warehouseStore.fetchEditWarehouse(warehouse.id, warehouse)
    await warehouseStore.fetchGetWarehouses()
    showEditWarehouseModal.value = false
}

// Delete Warehouse
const showDeleteWarehouseModal = ref(false)
const fetchDeleteWarehouse = async (warehouse: Warehouse) => {
    await warehouseStore.fetchDeleteWarehouse(warehouse.id)
    await warehouseStore.fetchGetWarehouses()
    showDeleteWarehouseModal.value = false
}

// TABLE EMITS
const onRowEdit = (row: Warehouse) => {
    selectedRow.value = row
    showEditWarehouseModal.value = true
}

const onRowDelete = (row: Warehouse) => {
    selectedRow.value = row
    showDeleteWarehouseModal.value = true
}
</script>

<template>
    <Table
        :rows="warehouseStore.warehouses"
        @row-delete="onRowDelete"
        @row-edit="onRowEdit"
    />

    <q-btn color="brown-6" icon="add" round @click="showAddWarehouseModal = true"/>

    <!--    MODALS    -->

    <q-dialog ref="dialogRef" v-model="showAddWarehouseModal" @hide="onDialogHide">
        <AddWarehouseForm
            @cancel="showAddWarehouseModal = false"
            @submit="fetchAddWarehouse"
        />
    </q-dialog>


    <q-dialog ref="dialogRef" v-model="showEditWarehouseModal" @hide="onDialogHide">
        <EditWarehouseForm
            :warehouse="selectedRow"
            @cancel="showEditWarehouseModal = false"
            @submit="fetchEditWarehouse"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showDeleteWarehouseModal" @hide="onDialogHide">
        <DeleteWarehouseForm
            :warehouse="selectedRow"
            @cancel="showDeleteWarehouseModal = false"
            @submit="fetchDeleteWarehouse"
        />
    </q-dialog>
    <!--    <div class="wrapper">-->
    <!--        <router-view/>-->
    <!--    </div>-->
</template>
