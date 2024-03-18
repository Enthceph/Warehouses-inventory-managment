<script lang="ts" setup>
import { useInventoriesStore } from '@/js/stores/inventories'
import Table from '@/js/components/Table/Table.vue'
import AddInventoryForm from '@/js/components/Forms/Inventory/AddInventoryForm.vue'
import DeleteInventoryForm from '@/js/components/Forms/Inventory/DeleteInventoryForm.vue'
import UpdateInventoryForm from '../components/Forms/Inventory/UpdateInventoryForm.vue'
import { Pagination, PaginationModel } from '../types/pagination.types'

const router = useRouter()
const route = useRoute()
const inventoriesStore = useInventoriesStore()

onMounted(async () => {
    await fetchNewPage({
        page: Number(route.query.page) || 1,
        per_page: Number(route.query.per_page) || 20,
    })
})

const pagination = reactive<PaginationModel>({
    page: 1,
    last_page: 1,
    per_page: 20,
})

const fetchNewPage = async (query: PaginationModel) => {
    let res = await inventoriesStore.fetchGetInventories({
        page: query.page,
        perPage: query.per_page || 20,
    })

    pagination.page = res.current_page
    pagination.last_page = res.last_page
    pagination.per_page = res.per_page

    router.replace({
        query: {
            page: pagination.page,
            perPage: pagination.per_page,
        },
    })
}

const columnNames = [
    'id',
    'Product',
    'Quantity',
    'Unit price',
    'The total cost',
    'Warehouse',
    'In stock since',
    'Expiry Date',
]

const columns = computed(() => {
    return inventoriesStore.inventories.map((inventory) => {
        return {
            id: inventory.id,
            product: inventory.product.name,
            quantity: inventory.quantity,
            unit_price: inventory.unit_price,
            total_value: inventory.total_value,
            warehouse: inventory.warehouse.name,
            created_at: new Date(inventory.created_at).toLocaleDateString(
                'ru-RU'
            ),
            expires_at:
                inventory.expires_at !== null
                    ? new Date(inventory.expires_at).toLocaleDateString('ru-RU')
                    : null,
        }
    })
})
</script>

<template>
    <Table
        :column-names="columnNames"
        :columns="columns"
        :data="inventoriesStore.inventories"
    >
        <template v-slot:addForm="{ submit, cancel }" #addForm>
            <AddInventoryForm @cancel="cancel" @submit="submit" />
        </template>

        <template v-slot:updateForm="{ submit, cancel, selected }" #updateForm>
            <UpdateInventoryForm
                :inventory="selected"
                @cancel="cancel"
                @submit="submit"
            />
        </template>

        <template v-slot:deleteForm="{ submit, cancel, selected }" #deleteForm>
            <DeleteInventoryForm
                :inventory="selected"
                @cancel="cancel"
                @submit="submit"
            />
        </template>
    </Table>

    <div class="q-pa-lg flex flex-center">
        <q-pagination
            v-model="pagination.page"
            @update:model-value="fetchNewPage(pagination)"
            :max="pagination.last_page || 1"
            :max-pages="7"
            direction-links
            gutter="md"
        />
    </div>
</template>
