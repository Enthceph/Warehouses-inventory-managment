<script lang="ts" setup>
import useApi from "@/js/composables/useApi";
import {useOutletStore} from "@/js/stores/outlet";

const outletStore = useOutletStore()
const route = useRoute()

const outlet = useApi('outlet/' + route.params.outlet).json()
outlet.onFetchResponse(() => {
    outletStore.setOutlet(outlet.data.value)
})

onUnmounted(() => {
    outletStore.clearOutlet()
})

</script>

<template>
    <div>org detail page</div>


    <q-tabs active-color="primary" class="text-grey" indicator-color="primary" narrow-indicator>
        <q-route-tab
            :to="`/outlets/${route.params.outlet}/overview`"
            label="обзор"
            name="overview"
        />
        <q-route-tab
            :to="`/outlets/${route.params.outlet}/transactions`"
            label="транзакции"
            name="transactions"
        />
        <q-route-tab
            :to="`/outlets/${route.params.outlet}/reports`"
            label="отчеты"
            name="reports"
        />
        <q-route-tab
            :to="`/outlets/${route.params.outlet}/employees`"
            label="сотрудники"
            name="employees"
        />
        <q-route-tab
            :to="`/outlets/${route.params.outlet}/settings`"
            label="настройки"
            name="settings"
        />
    </q-tabs>

    <div class="wrapper">
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
