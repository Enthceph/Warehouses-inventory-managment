<script lang="ts" setup>
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";
import {useInventoriesStore} from "@/js/stores/inventories";
import {Inventory} from "@/js/types/inventory.types";

const props = defineProps<{
    inventory: Inventory
}>()

const emit = defineEmits(['submit', 'cancel'])

const loading = ref(false)
const inventoriesStore = useInventoriesStore()


const submit = async () => {
    loading.value = true

    try {
        await inventoriesStore.fetchDeleteInventory(props.inventory.id)
    } catch (err) {
        console.log('DeleteInventoryForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submit')

    await inventoriesStore.fetchGetInventories()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper :loading="loading" action-label="Delete" title="Delete inventory" @cancel="cancel" @submit="submit">
        Do you really wish to delete <b>{{ props.inventory.product.name }}</b> in <b>{{
            props.inventory.warehouse.name
        }}</b> ?
    </FormWrapper>
</template>
