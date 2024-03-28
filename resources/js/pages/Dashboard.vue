<script lang="ts" setup>
import Chart from '../components/Chart.vue'
import { useInventoriesStore } from '@/js/stores/inventories'
import AnalyticsCard from '@/js/components/AnalyticsCard.vue'

const inventoriesStore = useInventoriesStore()

const type = ref<ApexChart['type']>('bar')
const initialLoaded = ref(false)
onMounted(async () => {
    await inventoriesStore.fetchGetInventories()
    initialLoaded.value = true
})

const labelsFromCountMap = (countMap: { [T: string]: number }) => {
    return Object.entries(countMap).map(([key, value]) => `${key} ${value}шт.`)
}

const productsByName = computed(() => {
    const countMap = <{ [T: string]: number }>{}

    inventoriesStore.inventories.forEach((item) => {
        const productName = item.product.name
        if (countMap[productName]) {
            countMap[productName] += 1
        } else {
            countMap[productName] = 1
        }
    })
    console.log(12322)
    return {
        labels: labelsFromCountMap(countMap),
        name: 'productsByName',
        data: Object.values(countMap),
    }
})

const productsByCategory = computed(() => {
    const countMap = <{ [T: string]: number }>{}

    inventoriesStore.inventories.forEach((item) => {
        const productCategory = item.product.category.name
        if (countMap[productCategory]) {
            countMap[productCategory] += 1
        } else {
            countMap[productCategory] = 1
        }
    })

    return {
        labels: labelsFromCountMap(countMap),
        name: 'Number of products by category',
        data: Object.values(countMap),
    }
})

const productsByQuantity = computed(() => {
    const countMap = <{ [T: string]: number }>{}

    inventoriesStore.inventories.forEach((item) => {
        const productName = item.product.name
        if (!countMap[productName]) {
            countMap[productName] = 0
        }
        countMap[productName] += item.quantity
    })

    return {
        labels: labelsFromCountMap(countMap),
        name: 'Number of products by name',
        data: Object.values(countMap),
    }
})

const productsByLocation = computed(() => {
    const countMap = <{ [T: string]: number }>{}

    inventoriesStore.inventories.forEach((item) => {
        let productLocation = item.warehouse.location

        if (!productLocation) return
        else {
            productLocation = productLocation.slice(0, 20) + '...'
        }

        if (countMap[productLocation]) {
            countMap[productLocation] += 1
        } else {
            countMap[productLocation] = 1
        }
    })

    return {
        labels: labelsFromCountMap(countMap),
        name: 'Number of products by location',
        data: Object.values(countMap),
    }
})

const productsByAdditional = computed(() => {
    const countMap = <{ [T: string]: number }>{}

    inventoriesStore.inventories.forEach((item) => {
        const productAdditional = item.product.additional_info
        if (!productAdditional) return

        if (countMap[productAdditional]) {
            countMap[productAdditional] += 1
        } else {
            countMap[productAdditional] = 1
        }
    })

    return {
        labels: labelsFromCountMap(countMap),
        name: 'The number of products per additional info',
        data: Object.values(countMap),
    }
})

const totalCostOfProducts = computed(() => {
    return inventoriesStore.inventories.reduce(
        (accumulator, item) => accumulator + Number(item.total_value),
        0
    )
})

const totalNumberOfProducts = computed(() => {
    return inventoriesStore.inventories.reduce(
        (accumulator, item) => accumulator + item.quantity,
        0
    )
})
</script>

<template>
    <q-card class="flex justify-between card">
        <analytics-card
            :number="totalCostOfProducts + ' uan.'"
            icon="credit_card"
            name="Total cost of products"
        />
        <analytics-card
            :number="122 + ' pcs.'"
            icon="inventory"
            name="The products will disappear soon"
        />
        <analytics-card
            :number="totalNumberOfProducts + ' pcs.'"
            icon="credit_card"
            name="Products in stock"
        />
    </q-card>

    <br /><br />

    <div v-if="initialLoaded" class="grid text-center">
        <q-card>
            <h2>{{ productsByCategory.name }}</h2>
            <Chart
                :labels="productsByCategory.labels"
                :series="productsByCategory.data"
                type="pie"
            />
        </q-card>

        <q-card>
            <h2>{{ productsByQuantity.name }}</h2>
            <Chart
                :labels="productsByQuantity.labels"
                :series="productsByQuantity.data"
                type="pie"
            />
        </q-card>
        <q-card>
            <h2>{{ productsByLocation.name }}</h2>
            <Chart
                :labels="productsByLocation.labels"
                :series="productsByLocation.data"
                type="pie"
            />
        </q-card>
        <q-card>
            <h2>{{ productsByAdditional.name }}</h2>
            <Chart
                :labels="productsByAdditional.labels"
                :series="productsByAdditional.data"
                type="pie"
            />
        </q-card>
    </div>
</template>

<style scoped>
.grid {
    display: grid;
    gap: 32px;
    grid-auto-rows: auto;
    grid-template-columns: 1fr 1fr;
    width: 100%;
}

.card {
    background-color: #1c77fb;
}
</style>
