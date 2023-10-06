<script lang="ts" setup>
const router = useRouter()
const route = useRoute()


</script>

<template>
    <q-tabs active-color="primary" class="text-grey" indicator-color="primary" narrow-indicator>
        <q-route-tab
            :to="`/warehouse/${route.params.id}/overview`"
            label="обзор"
            name="overview"
        />
        <q-route-tab
            :to="`/warehouse/${route.params.id}/transactions`"
            label="транзакции"
            name="transactions"
        />
        <q-route-tab
            :to="`/warehouse/${route.params.id}/reports`"
            label="отчеты"
            name="reports"
        />
        <q-route-tab
            :to="`/warehouse/${route.params.id}/settings`"
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
