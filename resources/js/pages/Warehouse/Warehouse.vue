<script lang="ts" setup>
const router = useRouter()
const route = useRoute()

const routeId = route.params.id
</script>

<template>
    <q-tabs active-color="primary" class="text-grey" indicator-color="primary" narrow-indicator>
        <q-route-tab
            :to="`/warehouse/${routeId}/overview`"
            label="обзор"
            name="overview"
        />
        <q-route-tab
            :to="`/warehouse/${routeId}/transactions`"
            label="транзакции"
            name="transactions"
        />
        <q-route-tab
            :to="`/warehouse/${routeId}/reports`"
            label="отчеты"
            name="reports"
        />
        <q-route-tab
            :to="`/warehouse/${routeId}/settings`"
            label="настройки"
            name="settings"
        />
    </q-tabs>

    <div class="wrapper">
        <router-view/>
    </div>
</template>
