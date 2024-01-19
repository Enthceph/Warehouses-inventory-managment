<script lang="ts" setup>
import Chart from '../components/Chart.vue'
import {useInventoriesStore} from "@/js/stores/inventories";

const inventoriesStore = useInventoriesStore()

const type = ref<ApexChart['type']>('bar')

onMounted(async () => {
    await inventoriesStore.fetchGetInventories()
    console.log(inventoriesStore.inventories)
})

const labelsFromCountMap = (countMap: { [T: string]: number }) => {
    return Object.entries(countMap).map(([key, value]) => `${key} ${value}шт.`);
}

const productsByName = computed(() => {
    const countMap = <{ [T: string]: number }>{};

    inventoriesStore.inventories.forEach(item => {
        const productName = item.product.name;
        if (countMap[productName]) {
            countMap[productName] += 1;
        } else {
            countMap[productName] = 1;
        }
    });

    return {
        labels: labelsFromCountMap(countMap),
        name: 'productsByName',
        data: Object.values(countMap)
    }
})

const productsByCategory = computed(() => {
    const countMap = <{ [T: string]: number }>{};

    inventoriesStore.inventories.forEach(item => {
        const productCategory = item.product.category.name;
        if (countMap[productCategory]) {
            countMap[productCategory] += 1;
        } else {
            countMap[productCategory] = 1;
        }
    });

    return {
        labels: labelsFromCountMap(countMap),
        name: 'productsByCategory',
        data: Object.values(countMap)
    }
})

const productsByQuantity = computed(() => {
    const countMap = <{ [T: string]: number }>{};

    inventoriesStore.inventories.forEach(item => {
        const productName = item.product.name;
        if (!countMap[productName]) {
            countMap[productName] = 0
        }
        countMap[productName] += item.quantity;
    });

    return {
        labels: labelsFromCountMap(countMap),
        name: 'productsByQuantity',
        data: Object.values(countMap)
    }
})

const productsByLocation = computed(() => {
    const countMap = <{ [T: string]: number }>{};

    inventoriesStore.inventories.forEach(item => {
        const productLocation = item.warehouse.location;
        if (countMap[productLocation]) {
            countMap[productLocation] += 1;
        } else {
            countMap[productLocation] = 1;
        }
    });

    return {
        labels: labelsFromCountMap(countMap),
        name: 'productsByLocation',
        data: Object.values(countMap)
    }
})
</script>

<template>
    <div class="grid text-center">
        <q-card>
            <h2>{{ productsByName.name }}</h2>
            <Chart :labels="productsByName.labels" :series="productsByName.data" type="pie"/>
        </q-card>

        <q-card>
            <h2>{{ productsByCategory.name }}</h2>
            <Chart :labels="productsByCategory.labels" :series="productsByCategory.data" type="pie"/>
        </q-card>

        <q-card>
            <h2>{{ productsByQuantity.name }}</h2>
            <Chart :labels="productsByQuantity.labels" :series="productsByQuantity.data" type="pie"/>
        </q-card>
        <q-card>
            <h2>{{ productsByLocation.name }}</h2>
            <Chart :labels="productsByLocation.labels" :series="productsByLocation.data" type="pie"/>
        </q-card>
    </div>


    <!--    <table v-for="inv in inventoriesStore.inventories">-->
    <!--        <tr>-->
    <!--            <td>id</td>-->
    <!--            <td>{{ inv.id }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>quantity</td>-->
    <!--            <td>{{ inv.quantity }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>unit_price</td>-->
    <!--            <td>{{ inv.unit_price }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>total_value</td>-->
    <!--            <td>{{ inv.total_value }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>product_id</td>-->
    <!--            <td>{{ inv.product_id }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>warehouse_id</td>-->
    <!--            <td>{{ inv.warehouse_id }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>created_at</td>-->
    <!--            <td>{{ inv.created_at }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>updated_at</td>-->
    <!--            <td>{{ inv.updated_at }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>deleted_at</td>-->
    <!--            <td>{{ inv.deleted_at }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>expires_at</td>-->
    <!--            <td>{{ inv.expires_at }}</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <hr/>-->
    <!--        </tr>-->
    <!--    </table>-->


</template>

<style scoped>
.grid {
    display:               grid;
    gap:                   32px;
    grid-template-columns: 1fr 1fr;
    width:                 100%;
}
</style>
