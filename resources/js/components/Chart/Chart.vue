<script lang="ts" setup>
import {Chart, registerables} from 'chart.js';
import {
    BarChart,
    BubbleChart,
    DoughnutChart,
    LineChart,
    PieChart,
    PolarAreaChart,
    RadarChart,
    ScatterChart,
} from 'vue-chart-3'

import {computed, onMounted, reactive, watch} from "vue";
import useCategories from "../../composables/useCategories";
import {Transaction, Transactions} from "@/js/types/transactions";
import {Bar} from "./chart.options";

const {getCategoryColor, getArrayColors} = useCategories()

Chart.register(...registerables);


//TODO chart поломан нахуй и его слишком долго чинить для этого проекта
const props = defineProps<{
    type: 'Bar' | 'Doughnut' | 'Line' | 'Pie' | 'PolarArea' | 'Radar' | 'Bubble' | 'Scatter',
    data: Transactions,
    divide?: boolean,
    options?: Object
}>()


const chartType = computed(() => {
    if (props.type === 'Bar') return BarChart
    if (props.type === 'Doughnut') return DoughnutChart
    if (props.type === 'Line') return LineChart
    if (props.type === 'Pie') return PieChart
    if (props.type === 'PolarArea') return PolarAreaChart
    if (props.type === 'Radar') return RadarChart
    if (props.type === 'Bubble') return BubbleChart
    if (props.type === 'Scatter') return ScatterChart
})

const options = reactive({
    responsive: true,
    maintainAspectRatio: false,
    aspectRatio: 1,

    plugins: {
        legend: {
            display:true,
            position: 'bottom',
        },
    },
    hover: {
        // mode: 'index',
        // intersect: true,

    },
    scales: {
        x: {},
        y: {
            ticks: {
                beginAtZero: true
            }
        }
    }
});

const getDataForPieAndDoughnut = () => {
    if (props.divide) {
        let amountsMap = new Map()

        props.data.forEach((obj) => {
            if (!amountsMap.get(obj.category)) amountsMap.set(obj.category, 0)

            let currentAmount = amountsMap.get(obj.category)

            if (obj.type === 'income') currentAmount += obj.amount
            if (obj.type === 'expense') currentAmount -= obj.amount

            amountsMap.set(obj.category, currentAmount)
        })

        amountsMap = new Map([...amountsMap.entries()].sort((a, b) => a[1] - b[1]))

        let colors = [...amountsMap.values()].map(amount => amount > 0 ? 'Limegreen' : 'Crimson')

        return {
            labels: Array.from(amountsMap.keys()),
            datasets: [{
                backgroundColor: colors,
                data: Array.from(amountsMap.values())
            }]
        }

    }
    if (!props.divide) {
        const amountsMap = new Map()

        props.data.forEach((obj) => {
            if (!amountsMap.get(obj.category)) amountsMap.set(obj.category, 0)

            let currentAmount = amountsMap.get(obj.category)

            if (obj.type === 'income') currentAmount += obj.amount
            if (obj.type === 'expense') currentAmount -= obj.amount

            amountsMap.set(obj.category, currentAmount)
        })

        return {
            labels: Array.from(amountsMap.keys()),
            datasets: [{
                backgroundColor: getArrayColors(Array.from(amountsMap.keys())),
                data: Array.from(amountsMap.values())
            }]
        }
    }
}

const getDataForLine = () => {
    if (props.divide) {
        const labels = [...new Set(props.data.map((data) => data.date))].sort()
        const incomes = {
            label: 'Доходы',
            data: [],
            backgroundColor: 'Limegreen',
            borderColor: 'Limegreen',
            tension: 0.4
        }
        const expenses = {
            label: 'Расходы',
            data: [],
            backgroundColor: 'Crimson',
            borderColor: 'Crimson',
            tension: 0.4
        }

        props.data.forEach((obj) => {
            if (obj.type === 'income') {
                incomes.data.push(obj.amount)
                expenses.data.push(NaN)
            }
            if (obj.type === 'expense') {
                expenses.data.push(obj.amount * -1)
                incomes.data.push(NaN)
            }
        })

        return {
            labels: labels,
            datasets: [incomes, expenses]
        }
    }

    if (!props.divide) {
        const data = []
        const colors = []
        const labels = new Set()

        props.data.forEach((obj) => {
            if (obj.type === 'income') {
                data.push(obj.amount)
                colors.push(getCategoryColor(obj.category))
            }
            if (obj.type === 'expense') {
                data.push(-obj.amount)
                colors.push(getCategoryColor(obj.category))
            }
            labels.add(obj.date)
        })

        return {
            labels: [...labels].sort(),
            datasets: [{
                label: 'Транзакции',
                data: data,
                backgroundColor: colors,
                pointBorderColor: colors,
                borderColor: '#696969',
                pointRadius: 3,
                borderJoinStyle: 'round',
                tension: 0.3
            }]
        }
    }

}

const getDataForBar = () => {
    Object.assign(options, Bar)

    if(props.divide){
        let amountsMap = new Map()

        props.data.forEach((obj) => {
            if (!amountsMap.get(obj.category)) amountsMap.set(obj.category, 0)

            let currentAmount = amountsMap.get(obj.category)

            if (obj.type === 'income') currentAmount += obj.amount
            if (obj.type === 'expense') currentAmount -= obj.amount

            amountsMap.set(obj.category, currentAmount)
        })

        amountsMap = new Map([...amountsMap.entries()].sort((a, b) => a[1] - b[1]))

        let colors = [...amountsMap.values()].map(amount => amount > 0 ? 'Limegreen' : 'Crimson')

        // options.plugins.legend.display = false

        return {

            labels: Array.from(amountsMap.keys()),
            datasets: [{
                backgroundColor: colors,
                data: Array.from(amountsMap.values())
            }]
        }
    }
    if(!props.divide){
        return divideDatasetsByCategories()
    }
}

const divideDatasetsByCategories = () => {
    const labels = [...new Set(props.data.map((data) => data.date))].sort()
    const amountsMap = new Map()

    props.data.forEach((obj) => {
        amountsMap.set(obj.category, [])
    })

    props.data.forEach((obj: Transaction) => {

        for (let entry of amountsMap.entries()) {
            if (entry[0] == obj.category)
                entry[1].push(obj.type === 'income' ? obj.amount : -obj.amount)
            else
                entry[1].push(null)
        }
    })

    console.log(amountsMap)

    const datasets = Array.from(amountsMap).map(([key, value]) => {
        // key, value

        return {
            label: key,
            data: value,
            backgroundColor: getCategoryColor(key)
        }
    });
    console.log(datasets)

    return {
        labels: labels,
        datasets: datasets
    }
}


const datasets = computed(() => {

    if (props.type === 'Doughnut' || props.type === 'Pie')
        return getDataForPieAndDoughnut()

    if (props.type === "Line") {
        return getDataForLine()
    }
    if (props.type === "Bar") {

        return getDataForBar()
    }


    if (!props.data) return []

    const datasets = []

    if (!props.divide) {
        const datasetData = []
        const datasetBackgroundColors = []

        props.data.forEach((obj) => {
            if (obj.type === 'income') {
                datasetData.push(obj.amount)
                datasetBackgroundColors.push(getCategoryColor(obj.category))
            }
            if (obj.type === 'expense') {
                datasetData.push(obj.amount * -1)
                datasetBackgroundColors.push(getCategoryColor(obj.category))
            }
        })

        datasets.push({
            data: datasetData,
            backgroundColor: datasetBackgroundColors
        })
    } else {
        const incomeObj = {
            label: 'Доходы',
            data: [],
            backgroundColor: 'Limegreen',
            // borderColor:'Limegreen',
            tension: 0.4
        }
        const expenseObj = {
            label: 'Расходы',
            data: [],
            backgroundColor: 'Crimson',
            // borderColor:[],
            tension: 0.4
        }

        props.data.forEach((obj) => {
            if (obj.type === 'income') {
                incomeObj.data.push(obj.amount)
                expenseObj.data.push(NaN)
            }
            if (obj.type === 'expense') {
                expenseObj.data.push(obj.amount * -1)
                incomeObj.data.push(NaN)
            }
        })

        datasets.push(incomeObj, expenseObj)
    }

    return {
        labels: props.data.map(el => el.category),
        datasets: datasets
    }
})

watch(datasets, (newVal) => {
    // console.log(newVal)

})



onMounted(() => {
    // Object.assign(options, props.options)

})


</script>

<template>
    <!--    <div class="dev">{{datasets}}</div>-->
    <!-- Chart -->
    <component
        :is="chartType"
        :chartData="datasets"
        :options="options"
    />
</template>

<style scoped>

</style>
