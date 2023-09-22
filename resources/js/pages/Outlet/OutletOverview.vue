<script setup lang="ts">
const options: ApexCharts.ApexOptions = {
    chart: {
        height: 350,
        type: 'line',
    },
    stroke: {
        width: [0, 4]
    },
    dataLabels: {
        enabled: true,
        enabledOnSeries: [1]
    },
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    xaxis: {
        type: 'category'
    },
}
const series: ApexAxisChartSeries = [
    {
        name: 'Profits',
        type: 'column',
        data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160],
        color: '#008000'

    }, {
        name: 'Expenes',
        type: 'column',
        data: [400, -350, 389, 644, 334, 127, 180, 123, 752, 320, 257, 160],
        color: '#808080',

    },
    {
        name: 'Net profit',
        type: 'line',
        data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
    }
]
</script>

<template>
    <div class="q-gutter-y-md column">
        <q-card>
            <q-card-section>
                <h3 class="text-h5">Profit and loss</h3>
            </q-card-section>

            <q-card-section horizontal class="flex justify-around gap-6 p-8">
                <q-card flat bordered class="flex-1 p-2">
                    <q-card-section class="text-h5">Total Revenue</q-card-section>
                    <q-card-section class="text-h4">20222</q-card-section>
                </q-card>

                <q-card flat bordered class=" flex-1 p-2">
                    <q-card-section class="text-h5">Total Expenses</q-card-section>
                    <q-card-section class="text-h4">20222</q-card-section>
                </q-card>

                <q-card flat bordered class="flex-1 p-2">
                    <q-card-section class="text-h5">Net profit</q-card-section>
                    <q-card-section class="text-h4">20222</q-card-section>
                </q-card>
            </q-card-section>

            <apexchart type="bar" :options="options" :series="series" />

        </q-card>

        <q-card>
            <q-card-section class="bg-red-100" horizontal>
                <h3 class="text-h5">Top expenses</h3>
                <q-space />
                <span class="texth-6">21 sep 2023 - 21 oct 2023</span>
            </q-card-section>
        </q-card>
    </div>
</template>

<style scoped >
.profitAndLossCard {
    padding: 16px;
}

.w {
    color: #808080;
}
</style>
