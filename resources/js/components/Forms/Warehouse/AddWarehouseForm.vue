<script lang="ts" setup>
import { useWarehousesStore } from '@/js/stores/warehouses'
import { AddWarehouseForm } from '@/js/types/warehouse.types'
import FormWrapper from '@/js/components/Forms/FormWrapper.vue'

const emit = defineEmits(['submit', 'cancel'])

const warehouse = reactive<AddWarehouseForm>({
    name: '',
    location: '',
    contactInfo: '',
})

const loading = ref(false)
const warehouseStore = useWarehousesStore()

const submit = async () => {
    loading.value = true

    try {
        await warehouseStore.fetchAddWarehouse(warehouse)
    } catch (err) {
        console.log('AddWarehouseForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submit')

    await warehouseStore.fetchGetWarehouses()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper
        :loading="loading"
        action-label="Add"
        title="Add warehouse"
        @cancel="cancel"
        @submit="submit"
    >
        <q-input
            v-model="warehouse.name"
            :rules="[
                (v) =>
                    v.length >= 2 ||
                    `The warehouse name must have at least 2 letters`,
            ]"
            hide-bottom-space
            label="Warehouse name"
            placeholder="Enter warehouse name"
            required
        />

        <q-input
            v-model="warehouse.location"
            label="Warehouse location"
            placeholder="Enter warehouse location"
        />

        <q-input
            v-model="warehouse.contactInfo"
            label="Contact information"
            placeholder="Enter contact information"
        />
    </FormWrapper>
</template>
