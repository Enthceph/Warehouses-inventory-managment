<script lang="ts" setup>
import {useWarehousesStore} from "@/js/stores/warehouses";
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";
import {Inventory, InventoryFormData} from "@/js/types/inventory.types";
import {useInventoriesStore} from "@/js/stores/inventories";
import {useProductsStore} from "@/js/stores/products";

const props = defineProps<{
    inventory: Inventory
}>()

const emit = defineEmits(['submit', 'cancel'])

onMounted(() => {
    productStore.fetchGetProducts()
    warehouseStore.fetchGetWarehouses()
})

const loading = ref(false)
const inventoryStore = useInventoriesStore()
const productStore = useProductsStore()
const warehouseStore = useWarehousesStore()

const inventory = reactive<InventoryFormData>({
    quantity: props.inventory.quantity,
    unit_price: props.inventory.unit_price,
    total_value: props.inventory.total_value,
    product_id: props.inventory.product_id,
    warehouse_id: props.inventory.warehouse_id,
    expires_at: props.inventory.expires_at,
})

watch(inventory, () => {
    inventory.total_value = inventory.quantity * inventory.unit_price
})

const submit = async () => {
    loading.value = true

    try {
        await inventoryStore.fetchEditInventory(props.inventory.id, inventory)
    } catch (err) {
        console.log('EditInventoryForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submit', inventory)

    await inventoryStore.fetchGetInventories()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper :loading="loading" action-label="Edit" title="Edit inventory" @cancel="cancel" @submit="submit">
        <q-input
            v-model.number="inventory.quantity"
            label="Quantity"
            placeholder="Enter quantity"
            required
            type="number"
        />

        <q-input
            v-model.number="inventory.unit_price"
            label="Unit price"
            placeholder="Enter unit price"
            required
            type="number"
        />
        <q-input
            v-model.number="inventory.total_value"
            disable
            label="Total value"
            required
            type="number"
        />
        <q-select
            v-model="inventory.product_id"
            :disable="loading "
            :options="productStore.products"
            :rules="[v =>  v || 'Product should be selected']"
            emit-value
            hide-bottom-space
            label="Product"
            map-options
            option-label="name"
            option-value="id"
            options-dense
            required
        />
        <q-select
            v-model="inventory.warehouse_id"
            :disable="loading"
            :options="warehouseStore.warehouses"
            :rules="[v =>  v || 'Warehouse should be selected']"
            emit-value
            hide-bottom-space
            label="Warehouse"
            map-options
            option-label="name"
            option-value="id"
            options-dense
            required
        />
        <q-input
            v-model="inventory.expires_at"
            clearable
            filled
            label="Expires at"
            type="date"
        />
    </FormWrapper>

</template>
