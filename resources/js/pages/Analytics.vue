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
    additional_info: [],
    warehouses: [],
    outlets: [],
    unit_price: undefined,
    total_value: undefined,
    quantity: undefined,
    created_at: undefined,
})

const filterModels = reactive<AnalyticsFilterModels>({
    products: undefined,
    warehouses: undefined,
    outlets: undefined,
    additional_info: undefined,
    quantity: undefined,
    created_at: undefined,
    expires_at: undefined,
    unit_price: undefined,
    total_value: undefined,
})

const submit = async () => {
    const query = filterModelsToUrlQuery(filterModels)

    router.replace({ query })

    filteredInventory.value = await getInventories(query)
}

const clear = () => {
    filterModels.products = undefined
    filterModels.warehouses = undefined
    filterModels.outlets = undefined
    filterModels.additional_info = undefined
    filterModels.quantity = undefined
    filterModels.created_at = undefined
    filterModels.expires_at = undefined
    filterModels.unit_price = undefined
    filterModels.total_value = undefined
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
                name="additional_info"
                label="Additional info"
                v-model="filterModels.additional_info"
                :options="filterOptions.additional_info"
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
                            <q-date v-model="filterModels.created_at" range>
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
                            <q-date v-model="filterModels.expires_at" range>
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
                    v-model="filterModels.unit_price"
                    :max="filterOptions.unit_price?.max"
                    :min="filterOptions.unit_price?.min"
                />

                <div class="minmax flex justify-between">
                    <span>{{ filterOptions.unit_price?.min }}</span>
                    <span>{{ filterOptions.unit_price?.max }}</span>
                </div>
            </div>

            <div class="q-pa-md">
                <div class="q-mb-sm text-center">Total value</div>

                <q-range
                    label
                    v-model="filterModels.total_value"
                    :max="filterOptions.total_value?.max"
                    :min="filterOptions.total_value?.min"
                />

                <div class="minmax flex justify-between">
                    <span>{{ filterOptions.total_value?.min }}</span>
                    <span>{{ filterOptions.total_value?.max }}</span>
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
