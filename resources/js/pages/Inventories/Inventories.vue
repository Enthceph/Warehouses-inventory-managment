<script lang="ts" setup>
import {useInventoriesStore} from "@/js/stores/inventories";

const inventoriesStore = useInventoriesStore()

onMounted(() => {
    inventoriesStore.fetchGetInventories()
})
</script>

<template>
    InventorIES page

    {{ inventoriesStore.inventories }}
</template>

<style scoped>

</style>
