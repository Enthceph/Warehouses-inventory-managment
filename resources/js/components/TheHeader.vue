<script lang="ts" setup>
import {useUserStore} from "@/js/stores/user";
import TheUserBadge from "@/js/components/TheUserBadge.vue";
import {useWarehousesStore} from "@/js/stores/warehouses";

const route = useRoute()
const warehouseStore = useWarehousesStore()
const userStore = useUserStore()

onMounted(() => {
    userStore.fetchUser()
})

</script>

<template>
    <header class="bg-green-700">
        <TheUserBadge/>

        <h2 class="text-h6 font-bold">
            <span>{{ route.name }}</span>
            <span v-if="route.name === 'Warehouse' && warehouseStore.selectedWarehouse">: {{
                    warehouseStore.selectedWarehouse.name
                }}</span>
        </h2>


        <router-link class="ml-auto" to="/settings">
            <q-icon name="settings"/>
        </router-link>
    </header>
</template>

<style scoped>
header {
    align-items:     center;
    color:           var(--va-text-primary);
    display:         flex;
    gap:             12px;
    justify-content: flex-start;
    padding:         16px 16px 16px 0;
}
</style>
