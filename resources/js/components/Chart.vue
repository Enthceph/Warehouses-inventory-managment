<script lang="ts" setup>
import { ApexOptions } from 'apexcharts'

const props = defineProps<{
    type: ApexChart['type']
    series: Object[]
    options?: Object
    labels: ApexOptions['labels']
}>()

const options = reactive<ApexOptions>({
    labels: props.labels,
})
</script>

<template>
    <apexchart :options="options" :series="props.series" :type="props.type" />
</template>

<style scoped></style>
