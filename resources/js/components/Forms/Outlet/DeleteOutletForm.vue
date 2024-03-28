<script lang="ts" setup>
import { useOutletsStore } from '@/js/stores/outlets'
import { Outlet } from '@/js/types/outlet.types'
import FormWrapper from '@/js/components/Forms/FormWrapper.vue'

const emit = defineEmits(['submit', 'cancel'])

const loading = ref(false)
const outletStore = useOutletsStore()

const props = defineProps<{
    outlet: Outlet
}>()

const submit = async () => {
    loading.value = true

    try {
        await outletStore.fetchDeleteOutlet(props.outlet.id)
    } catch (err) {
        console.log('DeleteOutletForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submit')

    await outletStore.fetchGetOutlets()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper
        :loading="loading"
        action-label="Delete"
        title="Delete outlet"
        @cancel="cancel"
        @submit="submit"
    >
        Do you really wish to delete {{ props.outlet.name }}?
    </FormWrapper>
</template>
