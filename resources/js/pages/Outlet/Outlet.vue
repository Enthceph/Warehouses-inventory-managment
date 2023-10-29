<script lang="ts" setup>
import useApi from "@/js/composables/useApi";
import {useOutletStore} from "@/js/stores/outlet";
import {useQuasar} from 'quasar'

const $q = useQuasar()
const outletStore = useOutletStore()
const router = useRouter()
const route = useRoute()

const outlet = useApi('outlet/' + route.params.outlet).json()
outlet.onFetchResponse(() => {
    outletStore.setOutlet(outlet.data.value)
})
outlet.onFetchError(() => {
    $q.notify({
        message: outlet.error.value,
        type: 'negative',
        position: 'top-right'
    })

    router.push('/organisation')
})
onUnmounted(() => {
    outletStore.clearOutlet()
})

const tab = ref('overview')

</script>

<template>
    <q-tabs v-model="tab" active-color="primary" class="text-grey" indicator-color="primary" narrow-indicator>
        <q-route-tab
            :to="`/outlet/${route.params.outlet}/overview`"
            label="обзор"
            name="overview"
        />
        <q-route-tab
            :to="`/outlet/${route.params.outlet}/transactions`"
            label="транзакции"
            name="transactions"
        />
        <q-route-tab
            :to="`/outlet/${route.params.outlet}/reports`"
            label="отчеты"
            name="reports"
        />
        <q-route-tab
            :to="`/outlet/${route.params.outlet}/employees`"
            label="сотрудники"
            name="employees"
        />
        <q-route-tab
            :to="`/outlet/${route.params.outlet}/settings`"
            label="настройки"
            name="settings"
        />
    </q-tabs>

    <div class="wrapper">
        <router-view/>
    </div>
</template>

<style scoped>

</style>
