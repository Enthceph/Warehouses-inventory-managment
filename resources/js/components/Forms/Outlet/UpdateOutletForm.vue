<script lang="ts" setup>
import { useOutletsStore } from '@/js/stores/outlets'
import { Outlet, OutletFormData } from '@/js/types/outlet.types'
import { useWarehousesStore } from '@/js/stores/warehouses'
import FormWrapper from '@/js/components/Forms/FormWrapper.vue'

const props = defineProps<{
    outlet: Outlet
}>()

const emit = defineEmits(['submitted', 'cancel'])

const outletsStore = useOutletsStore()
const warehousesStore = useWarehousesStore()

const loading = ref(false)

const outlet = reactive<OutletFormData>({
    name: props.outlet.name,
    address: props.outlet.address,
    contactInfo: props.outlet.contactInfo,
    warehouseId: props.outlet.warehouseId,
})

onMounted(() => {
    warehousesStore.fetchGetWarehouses()
    console.log(props.outlet)
})

const submit = async () => {
    loading.value = true
    try {
        await outletsStore.fetchUpdateOutlet(props.outlet.id, outlet)
    } catch (err) {
        console.log('UpdateOutletForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submitted', outlet)

    await outletsStore.fetchGetOutlets()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper
        :loading="loading"
        action-label="Update"
        title="Update outlet"
        @cancel="cancel"
        @submit="submit"
    >
        <q-input
            v-model="outlet.name"
            :rules="[
                (v) =>
                    v.length >= 2 ||
                    `The point name must have at least 2 letters`,
            ]"
            hide-bottom-space
            label="Name"
            placeholder="Enter outlet name"
            required
        />

        <q-input
            v-model="outlet.address"
            label="Address"
            placeholder="Enter outlet address"
        />

        <q-input
            v-model="outlet.contactInfo"
            label="Contact info"
            placeholder="Enter contact info"
        />

        <q-select
            v-model="outlet.warehouseId"
            :disable="loading"
            :options="warehousesStore.warehouses"
            :rules="[(v) => v || 'Warehouse should be selected']"
            emit-value
            hide-bottom-space
            label="Warehouse"
            map-options
            option-label="name"
            option-value="id"
            options-dense
        />
    </FormWrapper>
</template>
