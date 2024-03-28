<script lang="ts" setup>
import { getAnalyticsFilterInfo, getInventories } from '@/js/api/inventory'
import {
    AnalyticsFilterModels,
    AnalyticsFilterOptions,
    Inventory,
} from '../types/inventory.types'
import Table from '../components/Table/Table.vue'

const router = useRouter()

onMounted(async () => {
    Object.assign(filterOptions, await getAnalyticsFilterInfo())
})

const filteredInventory = ref<Inventory[]>([])

const filterOptions = reactive<AnalyticsFilterOptions>({
    products: [],
    additionalInfo: [],
    warehouses: [],
    outlets: [],
    unitPrice: undefined,
    totalValue: undefined,
    quantity: undefined,
    createdAt: undefined,
})

const filterModels = reactive<AnalyticsFilterModels>({
    products: undefined,
    warehouses: undefined,
    outlets: undefined,
    additionalInfo: undefined,
    quantity: undefined,
    createdAt: undefined,
    expiresAt: undefined,
    unitPrice: undefined,
    totalValue: undefined,
})

const submit = async () => {
    const query = filterModelsToUrlQuery(filterModels)

    router.replace({ query })

    const inventoryPagination = await getInventories(query)
    filteredInventory.value = inventoryPagination.data
}

const clear = () => {
    filterModels.products = undefined
    filterModels.warehouses = undefined
    filterModels.outlets = undefined
    filterModels.additionalInfo = undefined
    filterModels.quantity = undefined
    filterModels.createdAt = undefined
    filterModels.expiresAt = undefined
    filterModels.unitPrice = undefined
    filterModels.totalValue = undefined
}

const tableColumnNames = [
    'id',
    'Product',
    'Quantity',
    'Unit price',
    'Total value',
    'Warehouse',
    'Arrived at warehouse at',
    'Expires at',
]

const tableData = computed(() =>
    filteredInventory.value.map((inventory) => {
        return {
            id: inventory.id,
            product: inventory.product.name,
            quantity: inventory.quantity,
            unitPrice: inventory.unitPrice,
            totalValue: inventory.totalValue,
            warehouse: inventory.warehouse.name,
            createdAt: new Date(inventory.createdAt).toLocaleDateString(
                'ru-RU'
            ),
            expiresAt:
                inventory.expiresAt !== null
                    ? new Date(inventory.expiresAt).toLocaleDateString('ru-RU')
                    : null,
        }
    })
)

const filterModelsToUrlQuery = (filterModels: AnalyticsFilterModels) => {
    const query: { [key: string]: string | number } = {}

    Object.entries(toRaw(filterModels)).forEach(([key, param]) => {
        if (!param) return

        if (isObject(param)) {
            Object.entries(param).forEach(([paramKey, paramValue]) => {
                // @ts-ignore
                query[`${key}_${paramKey}`] = paramValue
            })

            return
        }

        query[key] = param
    })

    return query
}

const isObject = (objValue: any): boolean => {
    return (
        objValue &&
        typeof objValue === 'object' &&
        objValue.constructor === Object
    )
}
</script>

<template>
    <q-form @submit.prevent="submit">
        <div class="search-form">
            <q-select
                name="products"
                label="Products"
                v-model="filterModels.products"
                :options="filterOptions.products"
                multiple
                filled
            />

            <q-select
                name="warehouses"
                label="Warehouses"
                v-model="filterModels.warehouses"
                :options="filterOptions.warehouses"
                multiple
                filled
            />

            <q-select
                name="outlets"
                label="Outlets"
                v-model="filterModels.outlets"
                :options="filterOptions.outlets"
                multiple
                filled
            />

            <q-select
                name="additionalInfo"
                label="Additional info"
                v-model="filterModels.additionalInfo"
                :options="filterOptions.additionalInfo"
                multiple
                filled
            />

            <div></div>

            <div class="q-pa-md">
                <div class="q-mb-sm text-center">Arrived to warehouse</div>
                <div class="flex-center">
                    <q-btn
                        class="flex-center"
                        color="primary"
                        icon="event"
                        round
                    >
                        <q-popup-proxy
                            cover
                            transition-hide="scale"
                            transition-show="scale"
                        >
                            <q-date v-model="filterModels.createdAt" range>
                                <div
                                    class="row items-center justify-end q-gutter-sm"
                                >
                                    <q-btn
                                        v-close-popup
                                        color="primary"
                                        flat
                                        label="Cancel"
                                    />
                                    <q-btn
                                        v-close-popup
                                        color="primary"
                                        flat
                                        label="OK"
                                    />
                                </div>
                            </q-date>
                        </q-popup-proxy>
                    </q-btn>
                </div>
            </div>

            <div class="q-pa-md">
                <div class="q-mb-sm text-center">Terms of expiring</div>
                <div class="flex-center">
                    <q-btn
                        class="flex-center"
                        color="primary"
                        icon="event"
                        round
                    >
                        <q-popup-proxy
                            cover
                            transition-hide="scale"
                            transition-show="scale"
                        >
                            <q-date v-model="filterModels.expiresAt" range>
                                <div
                                    class="row items-center justify-end q-gutter-sm"
                                >
                                    <q-btn
                                        v-close-popup
                                        color="primary"
                                        flat
                                        label="Cancel"
                                    />
                                    <q-btn
                                        v-close-popup
                                        color="primary"
                                        flat
                                        label="OK"
                                    />
                                </div>
                            </q-date>
                        </q-popup-proxy>
                    </q-btn>
                </div>
            </div>

            <div class="q-pa-md">
                <div class="q-mb-sm text-center">Unit prices</div>

                <q-range
                    label
                    v-model="filterModels.unitPrice"
                    :max="filterOptions.unitPrice?.max"
                    :min="filterOptions.unitPrice?.min"
                />

                <div class="minmax flex justify-between">
                    <span>{{ filterOptions.unitPrice?.min }}</span>
                    <span>{{ filterOptions.unitPrice?.max }}</span>
                </div>
            </div>

            <div class="q-pa-md">
                <div class="q-mb-sm text-center">Total value</div>

                <q-range
                    label
                    v-model="filterModels.totalValue"
                    :max="filterOptions.totalValue?.max"
                    :min="filterOptions.totalValue?.min"
                />

                <div class="minmax flex justify-between">
                    <span>{{ filterOptions.totalValue?.min }}</span>
                    <span>{{ filterOptions.totalValue?.max }}</span>
                </div>
            </div>
            <div class="q-pa-md">
                <div>Quantity</div>

                <q-range
                    label
                    v-model="filterModels.quantity"
                    :max="filterOptions.quantity?.max"
                    :min="filterOptions.quantity?.min"
                />

                <div class="minmax flex justify-between">
                    <span>{{ filterOptions.quantity?.min }}</span>
                    <span>{{ filterOptions.quantity?.max }}</span>
                </div>
            </div>
        </div>

        <div class="buttons">
            <q-btn unelevated class="btn-1" type="submit">Search</q-btn>
            <q-btn unelevated class="btn-2" type="reset" @click="clear"
                >Clear</q-btn
            >
        </div>
    </q-form>

    <Table
        v-if="filteredInventory.length > 0"
        :column-names="tableColumnNames"
        :columns="tableData"
        :data="tableData"
        :hide-action-buttons="true"
    />
</template>

<style scoped>
.search-form {
    background: #f0f0f0;
    border-radius: 10px;
    display: grid;
    gap: 10px;
    grid-template-columns: repeat(5, 1fr);
    grid-template-rows: 2;
    padding: 20px;
}

.search-form input,
.search-form select {
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    padding: 10px;
}

.buttons {
    background: #f0f0f0;
    border-radius: 10px;
    display: grid;
    gap: 10px;
    grid-template-columns: repeat(5, 1fr);
    padding: 20px;
}

.buttons .btn-1 {
    background-color: #1c77fb;
    /* Green */
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
}

.buttons .btn-2 {
    border: none;
    border-radius: 5px;
    color: #1c77fb;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
}

.search-form button:hover {
    background-color: #45a049;
}

.pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    margin-top: 15px;
    padding: 0;
}

.pagination li {
    margin: 0 5px;
}

.pagination li a {
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #333;
    padding: 8px 16px;
    text-decoration: none;
}

.pagination li a.active,
.pagination li a:hover {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}
</style>
@/js/api/inventory
