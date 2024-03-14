<script lang="ts" setup>
import { useWarehousesStore } from "@/js/stores/warehouses";
import { UpdateWarehouseForm, Warehouse } from "@/js/types/warehouse.types";
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";

const props = defineProps<{
    warehouse: Warehouse
}>()

const emit = defineEmits(['submit', 'cancel'])

const warehouse = reactive<UpdateWarehouseForm>({
    id: props.warehouse.id,
    name: props.warehouse.name,
    location: props.warehouse.location,
    contact_info: props.warehouse.contact_info,
})
const loading = ref(false)
const warehouseStore = useWarehousesStore()

const submit = async () => {
    loading.value = true

    try {
        await warehouseStore.fetchUpdateWarehouse(warehouse)
    } catch (err) {
        console.log('UpdateWarehouseForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submit', warehouse)

    await warehouseStore.fetchGetWarehouses()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper :loading="loading" action-label="Update" title="Update warehouse" @cancel="cancel" @submit="submit">
        <q-input v-model="warehouse.name"
            :rules="[v => v.length >= 2 || `The name of the warehouse must have at least 2 letters`]" hide-bottom-space
            label="Warehouse name" placeholder="Enter warehouse namex" required />

        <q-input v-model="warehouse.location" label="Warehouse location" placeholder="Enter warehouse location" />

        <q-input v-model="warehouse.contact_info" label="Contact information" placeholder="Enter contact information" />
    </FormWrapper>
</template>
