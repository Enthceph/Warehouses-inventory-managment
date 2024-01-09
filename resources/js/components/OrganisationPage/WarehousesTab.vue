<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import TabCard from "@/js/components/OrganisationPage/TabCard.vue";
import TabLayout from "@/js/components/OrganisationPage/TabLayout.vue";
import TabAddCard from "@/js/components/OrganisationPage/TabAddCard.vue";
import useApi from "@/js/composables/useApi";
import AddWarehouseForm, {Warehouse} from "@/js/components/Forms/Warehouse/AddWarehouseForm.vue";

defineEmits([...useDialogPluginComponent.emits])
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const warehouses = useApi('warehouse').get().json()

const showAddWarehouseModal = ref(false)

const fetchAddWarehouse = (data: Warehouse) => {
    const addWarehouseFetch = useApi('warehouse', {immediate: false}).post(data).json()
    addWarehouseFetch.execute().then(() => {
        warehouses.execute()
    })
}

const inventories = useApi('inventory').get().json()
</script>

<template>
    <TabLayout>
        <TabCard
            v-for="warehouse of warehouses.data.value"
            :name="warehouse.name"
            :to="`warehouse/${warehouse.id}/overview`"
        />

        <TabAddCard
            @click="showAddWarehouseModal = true"
        />
    </TabLayout>

    <q-dialog ref="dialogRef" v-model="showAddWarehouseModal" @hide="onDialogHide">
        <AddWarehouseForm
            @cancel="showAddWarehouseModal = false"
            @submit="fetchAddWarehouse"
        />
    </q-dialog>

    <div>вот здесь должены быть все инвентари</div>
    <div>{{ inventories.data }}</div>
</template>
