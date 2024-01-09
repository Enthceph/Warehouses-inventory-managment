<script lang="ts" setup>
const props = defineProps({
    row: Object,
    hideActionButtons: Boolean
})

const rowNames = computed(() => {
    if (!props.row) {
        return []
    }

    return Object.keys(props.row)
})
</script>

<template>
    <thead class="bg-gray-50">
    <tr>
        <th v-for="col in rowNames" class="px-6 py-4 font-medium text-gray-900" scope="col">{{ col }}</th>
        <th v-if="!hideActionButtons"></th>
    </tr>
    </thead>
</template>

<style scoped></style>
