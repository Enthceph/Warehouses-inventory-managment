<script lang="ts" setup>
import {useWarehousesStore} from "@/js/stores/warehouses";
import {Warehouse} from "@/js/types/warehouse.types";
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";

const props = defineProps<{
    warehouse: Warehouse
}>()

const emit = defineEmits(['submit', 'cancel'])
const warehouseStore = useWarehousesStore()
const loading = ref(false)

const submit = async () => {
    loading.value = true

    try {
        await warehouseStore.fetchDeleteWarehouse(props.warehouse.id)
    } catch (err) {
        console.log('DeleteWarehouseForm Error', err)
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
    <FormWrapper :loading="loading" action-label="Delete" title="Delete warehouse" @cancel="cancel" @submit="submit">
        You really want to delete the warehouse <b>{{ props.warehouse.name }}</b> ?
    </FormWrapper>
</template>
