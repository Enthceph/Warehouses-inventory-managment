<script lang="ts" setup>
import {useOutletStore} from "@/js/stores/outlet";
import {useQuasar} from 'quasar'
import {useFetching} from "@/js/composables/useFetching";
import {getOutlet} from "@/api/outlet";

const $q = useQuasar()
const outletStore = useOutletStore()
const router = useRouter()
const route = useRoute()

const outletId = route.params.outlet

const tab = ref('overview')

const {fetch: fetchGetOutlet, data: outlet, error} = useFetching(getOutlet)

onMounted(async () => {
    await fetchGetOutlet(outletId).then(() => {
        outletStore.setOutlet(outlet)
    }).catch(() => {
        $q.notify({
            message: error.value,
            type: 'negative',
            position: 'top-right'
        })

        router.push('/organisation')
    })
})

onUnmounted(() => {
    outletStore.clearOutlet()
})
</script>

<template>
    <q-tabs v-model="tab" active-color="primary" class="text-grey" indicator-color="primary" narrow-indicator>
        <q-route-tab
            :to="`/outlet/${outletId}/overview`"
            label="обзор"
            name="overview"
        />
        <q-route-tab
            :to="`/outlet/${outletId}/transactions`"
            label="транзакции"
            name="transactions"
        />
        <q-route-tab
            :to="`/outlet/${outletId}/reports`"
            label="отчеты"
            name="reports"
        />
        <q-route-tab
            :to="`/outlet/${outletId}/employees`"
            label="сотрудники"
            name="employees"
        />
        <q-route-tab
            :to="`/outlet/${outletId}/settings`"
            label="настройки"
            name="settings"
        />
    </q-tabs>

    <div class="wrapper">
        <router-view/>
    </div>
</template>
