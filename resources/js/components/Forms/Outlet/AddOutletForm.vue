<script lang="ts" setup>
import {useOutletsStore} from "@/js/stores/outlets";
import {OutletAddForm} from "@/js/types/outlet.types";
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";

const emit = defineEmits(['submit', 'cancel'])

const outlet = reactive<OutletAddForm>({
    name: '',
    address: '',
    contact_info: '',
    warehouse_name: null
})

const loading = ref(false)
const outletStore = useOutletsStore()

const submit = async () => {
    loading.value = true

    try {
        await outletStore.fetchAddOutlet(outlet)
    } catch (err) {
        console.log('AddOutletForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submit', outlet)

    await outletStore.fetchGetOutlets()
}
const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper :loading="loading" action-label="Add" title="Add outlet" @cancel="cancel" @submit="submit">
        <q-input
            v-model="outlet.name"
            :rules="[v => v.length >= 2 || `The outlet name must have at least 2 letters`]"
            hide-bottom-space
            label="Outlet name"
            placeholder="Enter the name of the outlet"
            required
        />

        <q-input
            v-model="outlet.address"
            label="Outlet address"
            placeholder="Enter outlet address"
        />

        <q-input
            v-model="outlet.contact_info"
            label="Contact Information"
            placeholder="Enter contact information"
        />

        <q-input
            v-model="outlet.warehouse_name"
            label="Warehouse name (optional)"
            placeholder="Enter warehouse name"
        />
    </FormWrapper>
</template>
