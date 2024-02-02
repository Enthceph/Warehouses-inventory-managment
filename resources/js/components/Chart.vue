<script lang="ts" setup>

import {ApexOptions} from "apexcharts";

const props = defineProps<{
    type: ApexChart["type"],
    series: Object[],
    // divide?: boolean,
    options?: Object
    labels: ApexOptions['labels']
}>()

const options = reactive<ApexOptions>({
    labels: props.labels,
    // xaxis: {
    //     categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
    // }
})


</script>

<template>
    <apexchart
        :options="options"
        :series="props.series"
        :type="props.type"
    />
</template>

<style scoped></style>
