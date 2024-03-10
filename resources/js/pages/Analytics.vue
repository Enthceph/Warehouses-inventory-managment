<script lang="ts" setup>
import { getAnalyticsFilterInfo } from "@/api/inventory";
import { AnalyticsFilterOptions } from "../types/inventory.types";


onMounted(async () => {
    Object.assign(filterOptions, await getAnalyticsFilterInfo().json())
})

const price = ref({
    min: 0,
    max: 9999
})

const totalPrice = ref({
    min: 200,
    max: 10000
})


const expires = ref({ from: '2020/07/08', to: '2020/07/17' })


// const columnNames = [
//     'id',
//     'Назва продукту',
//     'Кількість',
//     'Ціна за одиницю',
//     'Загальна вартість',
//     'Склад',
//     'Знаходится на складі з',
//     'Термін придатності(Якщо є)',
// ]

// const tableData = computed(() => {
//     let formattedInventory = inventoriesStore.inventories.map((inventory) => {
//         return {
//             id: inventory.id,
//             product: inventory.product.name,
//             quantity: inventory.quantity,
//             unit_price: inventory.unit_price,
//             total_value: inventory.total_value,
//             warehouse: inventory.warehouse.name,
//             created_at: new Date(inventory.created_at).toLocaleDateString('ru-RU'),
//             expires_at: inventory.expires_at !== null ? new Date(inventory.expires_at).toLocaleDateString('ru-RU') : null,
//         }
//     })

//     return formattedInventory.filter((inventory) => {
//         const currentDate = new Date();

//         const halfYearAgo = new Date(currentDate);
//         halfYearAgo.setMonth(currentDate.getMonth() - 6);

//         const weekAgo = new Date(currentDate);
//         weekAgo.setDate(currentDate.getDate() - 7);

//         return new Date(inventory.created_at) > halfYearAgo && inventory.quantity > 20 && inventory.warehouse == 'porro'
//     })
// })


const filterOptions = reactive<AnalyticsFilterOptions>({
    products: [],
    additional_info: [],
    warehouses: [],
    outlets: [],
    unit_price: undefined,
    total_value: undefined,
    quantity: undefined,
    created_at: undefined
})

const filterModels = reactive({
    products: [],//array +
    warehouses: [],//array + 
    outlets: [], //array +
    additional_info: null,//array
    quantity: undefined,//range 
    created_at: undefined, //date or range of dates
    expires_at: undefined, // date or range of dates
    unit_price: undefined,// range of unit_price
    total_value: undefined// range of total_value 
})
</script>

<template>
    <div class="search-form">
        <q-select name="products" label="Products" v-model="filterModels.products" :options="filterOptions.products"
            multiple filled />

        <div class="q-pa-md">
            <div>Quantity</div>

            <q-range v-model="filterModels.quantity" :max="filterOptions.quantity?.max"
                :min="filterOptions.quantity?.min" />

            <div class="minmax flex justify-between">
                <span>{{ filterOptions.quantity?.min }}</span>
                <span>{{ filterOptions.quantity?.max }}</span>
            </div>
        </div>

        <q-select name="warehouses" label="Warehouses" v-model="filterModels.warehouses"
            :options="filterOptions.warehouses" multiple filled />

        <q-select name="outlets" label="Outlets" v-model="filterModels.outlets" :options="filterOptions.outlets"
            multiple filled />

        <q-select name="additional_info" label="Additional info" v-model="filterModels.additional_info"
            :options="filterOptions.additional_info" multiple filled />


        <div class="q-pa-md">
            <div class="q-mb-sm text-center">
                Arrived to warehouse
            </div>
            <div class="flex-center">
                <q-btn class="flex-center" color="primary" icon="event" round>
                    <q-popup-proxy cover transition-hide="scale" transition-show="scale">
                        <q-date v-model="filterModels.created_at" range>
                            <div class="row items-center justify-end q-gutter-sm">
                                <q-btn v-close-popup color="primary" flat label="Cancel" />
                                <q-btn v-close-popup color="primary" flat label="OK" />
                            </div>
                        </q-date>
                    </q-popup-proxy>
                </q-btn>
            </div>
        </div>



        <div class="q-pa-md">
            <div class="q-mb-sm  text-center">
                Terms of expiring
            </div>
            <div class="flex-center">
                <q-btn class="flex-center" color="primary" icon="event" round>
                    <q-popup-proxy cover transition-hide="scale" transition-show="scale">
                        <q-date v-model="filterModels.expires_at">
                            <div class="row items-center justify-end q-gutter-sm">
                                <q-btn v-close-popup color="primary" flat label="Cancel" />
                                <q-btn v-close-popup color="primary" flat label="OK" />
                            </div>
                        </q-date>
                    </q-popup-proxy>
                </q-btn>
            </div>
        </div>

        <div class="q-pa-md">
            <div class="q-mb-sm  text-center">Unit prices</div>

            <q-range v-model="filterModels.unit_price" :max="filterOptions.unit_price?.max"
                :min="filterOptions.unit_price?.min" />

            <div class="minmax flex justify-between">
                <span>{{ filterOptions.unit_price?.min }}</span>
                <span>{{ filterOptions.unit_price?.max }}</span>
            </div>
        </div>


        <div class="q-pa-md">
            <div class="q-mb-sm  text-center">Total value</div>

            <q-range v-model="filterModels.total_value" :max="filterOptions.total_value?.max"
                :min="filterOptions.total_value?.min" />

            <div class="minmax flex justify-between">
                <span>{{ filterOptions.total_value?.min }}</span>
                <span>{{ filterOptions.total_value?.max }}</span>
            </div>
        </div>

        <div class="q-pa-md text-center">
            <div class="q-mb-sm  text-center">Download excel</div>
            <div class="px-6 py-4 text-center">
                <q-btn class="add-button" color="green" icon="note" round />
            </div>
        </div>


    </div>
    <div class="buttons">
        <button class="btn-1" type="submit">Пошук</button>
        <button class="btn-2">Очистити</button>
    </div>

    <table>
        <tr>
            <td>products</td>
            <td>{{ filterModels.products }}</td>
        </tr>
        <tr>
            <td>quantity</td>
            <td>{{ filterModels.quantity }}</td>
        </tr>
        <tr>
            <td>warehouses</td>
            <td>{{ filterModels.warehouses }}</td>
        </tr>
        <tr>
            <td>outlets</td>
            <td>{{ filterModels.outlets }}</td>
        </tr>
        <tr>
            <td>additional_info</td>
            <td>{{ filterModels.additional_info }}</td>
        </tr>
        <tr>
            <td>created_at</td>
            <td>{{ filterModels.created_at }}</td>
        </tr>
        <tr>
            <td>expires_at</td>
            <td>{{ filterModels.expires_at }}</td>
        </tr>
        <tr>
            <td>unit_price</td>
            <td>{{ filterModels.unit_price }}</td>
        </tr>
        <tr>
            <td>total_value</td>
            <td>{{ filterModels.total_value }}</td>
        </tr>
    </table>
    <!--    <Table-->
    <!--        :column-names="columnNames"-->
    <!--        :data="tableData"-->
    <!--        hide-action-buttons-->
    <!--    />-->


    <!--    <ul class="pagination">-->
    <!--        <li><a class="active" href="#">1</a></li>-->
    <!--        <li><a href="#">2</a></li>-->
    <!--        <li><a href="#">3</a></li>-->
    <!--        <li><a href="#">4</a></li>-->
    <!--        <li><span>...</span></li>-->
    <!--        <li><a href="#">7</a></li>-->
    <!--    </ul>-->
</template>

<style scoped>
.search-form {
    background: #f0f0f0;
    border-radius: 10px;
    display: grid;
    gap: 10px;
    grid-template-columns: repeat(5, 1fr);
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
    background-color: #1C77FB;
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
    color: #1C77FB;
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
