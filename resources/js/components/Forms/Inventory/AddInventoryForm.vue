<script lang="ts" setup>
import {InventoryFormData} from "@/js/types/inventory.types";
import {useInventoriesStore} from "@/js/stores/inventories";
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";
import {useProductsStore} from "@/js/stores/products";
import {useWarehousesStore} from "@/js/stores/warehouses";

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
    quantity: 0,
    unit_price: 0,
    total_value: 0,
    product_id: 0,
    warehouse_id: null,
    expires_at: null,
})

watch(inventory, () => {
    inventory.total_value = inventory.quantity * inventory.unit_price
})

const submit = async () => {
    loading.value = true

    try {
        await inventoryStore.fetchAddInventory(inventory)
    } catch (err) {
        console.log('AddInventoryForm Error', err)
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
    <FormWrapper :loading="loading" action-label="Add" title="Add inventory" @cancel="cancel" @submit="submit">
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
