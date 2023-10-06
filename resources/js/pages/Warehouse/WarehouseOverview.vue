<script lang="ts" setup>
import useApi from "@/js/composables/useApi";

const route = useRoute()
const inventory = useApi(`inventory/${route.params.id}`).get().json()
</script>

<template>
    <div>inventory overview</div>

    <div>{{ inventory.data }}</div>


</template>

<style scoped>

</style>
