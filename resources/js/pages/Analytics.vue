<script lang="ts" setup>
import {useInventoriesStore} from "@/js/stores/inventories";

const inventoriesStore = useInventoriesStore()

onMounted(async () => {
    await inventoriesStore.fetchGetInventories()

    console.log(inventoriesStore.inventories)
})
const price = ref({
    min: 0,
    max: 9999
})
const totalPrice = ref({
    min: 200,
    max: 10000
})


const expires = ref({from: '2020/07/08', to: '2020/07/17'})


const columnNames = [
    'id',
    'Назва продукту',
    'Кількість',
    'Ціна за одиницю',
    'Загальна вартість',
    'Склад',
    'Знаходится на складі з',
    'Термін придатності(Якщо є)',
]

const tableData = computed(() => {
    let formattedInventory = inventoriesStore.inventories.map((inventory) => {
        return {
            id: inventory.id,
            product: inventory.product.name,
            quantity: inventory.quantity,
            unit_price: inventory.unit_price,
            total_value: inventory.total_value,
            warehouse: inventory.warehouse.name,
            created_at: new Date(inventory.created_at).toLocaleDateString('ru-RU'),
            expires_at: inventory.expires_at !== null ? new Date(inventory.expires_at).toLocaleDateString('ru-RU') : null,
        }
    })

    return formattedInventory.filter((inventory) => {
        const currentDate = new Date();

        const halfYearAgo = new Date(currentDate);
        halfYearAgo.setMonth(currentDate.getMonth() - 6);

        const weekAgo = new Date(currentDate);
        weekAgo.setDate(currentDate.getDate() - 7);

        return new Date(inventory.created_at) > halfYearAgo && inventory.quantity > 20 && inventory.warehouse == 'porro'
    })
})
</script>

<template>

    <div class="search-form">
        <input id="brand" name="brand" placeholder="Продукт" type="text">
        <input id="model" name="model" placeholder="Кількість" type="text">
        <input id="object" name="object" placeholder="Склад" type="text">
        <input id="location" name="location" placeholder="Точка" type="text">
        <input id="additional-info-name" name="additional-info-name" placeholder="Дод. інформація" type="text">

        <div class="q-pa-md">
            <div>Знаходиться на складі з</div>
            <input id="location" name="location" placeholder="Точка" type="date">
        </div>

        <div class="q-pa-md">
            <div class="q-mb-sm">
                Діапазон терміну придатності
            </div>
            <div class="flex-center">
                <q-btn class="flex-center" color="primary" icon="event" round>
                    <q-popup-proxy cover transition-hide="scale" transition-show="scale">
                        <q-date v-model="expires">
                            <div class="row items-center justify-end q-gutter-sm">
                                <q-btn v-close-popup color="primary" flat label="Cancel"/>
                                <q-btn v-close-popup color="primary" flat label="OK"/>
                            </div>
                        </q-date>
                    </q-popup-proxy>
                </q-btn>
            </div>
        </div>

        <div class="q-pa-md">
            <div>Діапазон ціни</div>
            <q-range v-model="price" :max="price.max" :min="0"/>
            <div class="minmax flex justify-between">
                <span>{{ price.min }}</span>
                <span>{{ price.max }}</span>
            </div>
        </div>
        <div class="q-pa-md">
            <div>Діапазон загальної вартості</div>
            <q-range v-model="totalPrice" :max="totalPrice.max" :min="0"/>
            <div class="minmax flex justify-between">
                <span>{{ totalPrice.min }}</span>
                <span>7999</span>
            </div>
        </div>

        <div class="q-pa-md text-center">
            <div>Завантажити excel</div>
            <div class="px-6 py-4 text-center">
                <q-btn class="add-button" color="green" icon="note" round/>
            </div>
        </div>


    </div>
    <div class="buttons">
        <button class="btn-1" type="submit">Пошук</button>
        <button class="btn-2">Очистити</button>
    </div>

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
    background:            #f0f0f0;
    border-radius:         10px;
    display:               grid;
    gap:                   10px;
    grid-template-columns: repeat( 5, 1fr);
    padding:               20px;
}

.search-form input, .search-form select {
    border:        1px solid #ccc;
    border-radius: 5px;
    font-size:     14px;
    padding:       10px;
}

.buttons {
    background:            #f0f0f0;
    border-radius:         10px;
    display:               grid;
    gap:                   10px;
    grid-template-columns: repeat( 5, 1fr);
    padding:               20px;
}

.buttons .btn-1 {
    background-color: #1C77FB; /* Green */
    border:           none;
    border-radius:    5px;
    color:            white;
    cursor:           pointer;
    display:          inline-block;
    font-size:        14px;
    margin:           4px 2px;
    padding:          10px 20px;
    text-align:       center;
    text-decoration:  none;
}

.buttons .btn-2 {
    border:          none;
    border-radius:   5px;
    color:           #1C77FB;
    cursor:          pointer;
    display:         inline-block;
    font-size:       14px;
    margin:          4px 2px;
    padding:         10px 20px;
    text-align:      center;
    text-decoration: none;
}

.search-form button:hover {
    background-color: #45a049;
}

.pagination {
    display:         flex;
    justify-content: center;
    list-style:      none;
    margin-top:      15px;
    padding:         0;
}

.pagination li {

    margin: 0 5px;
}

.pagination li a {
    border:        1px solid #ddd;
    border-radius: 5px;
    color:         #333;
    padding:       8px 16px; text-decoration: none;
}

.pagination li a.active, .pagination li a:hover {
    background-color: #007bff;
    border-color:     #007bff;
    color:            white;
}
</style>
