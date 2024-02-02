<script lang="ts" setup>
import {useWarehousesStore} from "@/js/stores/warehouses";
import Table from "@/js/components/Table/Table.vue";

const route = useRoute()
const warehouseStore = useWarehousesStore()
const warehouse = reactive({})
onMounted(async () => {
    let res = await warehouseStore.fetchGetWarehouse(Number(route.params.warehouse))
    Object.assign(warehouse, res)
})

const columnNames = [
    'id',
    'Назва продукту',
    'Кількість',
    'Ціна за одиницю',
    'Загальна вартість',
    'Знаходится на складі з',
    'Термін придатності(Якщо є)',
]

const tableData = computed(() => {
    console.log(warehouse.inventory)
    if (!warehouse.inventory) return []

    return warehouse.inventory.map((inventory) => {
        return {
            id: inventory.id,
            product: inventory.product.name,
            quantity: inventory.quantity,
            unit_price: inventory.unit_price,
            total_value: inventory.total_value,
            created_at: new Date(inventory.created_at).toLocaleDateString('ru-RU'),
            expires_at: inventory.expires_at !== null ? new Date(inventory.expires_at).toLocaleDateString('ru-RU') : null,
        }
    })
})
</script>

<template>
    <q-card class="card">
        <div class="card-title">Склад: {{ warehouse.name }}</div>
        <div class="card-additional">
            <div>Місцезнаходження: {{ warehouse.location }}</div>
            <div>Контактна інформація: {{ warehouse.contact_info }}</div>
            <div>Був створений: {{ warehouse.created_at }}</div>
        </div>
    </q-card>

    <h2 class="text-h6 my-6">Інвентар</h2>

    <Table
        v-if="tableData.length > 0"
        :column-names="columnNames"
        :data="tableData"
        :hideAddButton="true"
    />
</template>
<style scoped>
.card {background-color: #1C77FB;
    color:               white;
    display:             flex;
    flex-direction:      column;
    gap:                 16px;
    padding:             32px;
}

.card-title {
    font-size:   26px;
    font-weight: 700;
}

.card-additional {
    display:        flex;
    flex-direction: column;
    font-size:      16px;
    gap:            12px;
}

</style>
