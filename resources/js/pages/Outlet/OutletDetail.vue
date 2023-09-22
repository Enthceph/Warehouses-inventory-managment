<script setup lang="ts">
const route = useRoute()
</script>

<template>
    <div>org detail page</div>
    <q-tabs class="text-grey" active-color="primary" indicator-color="primary" narrow-indicator>
        <q-route-tab :to="`/outlets/${route.params.outlet}/overview`" name="overview" label="обзор" />
        <q-route-tab :to="`/outlets/${route.params.outlet}/transactions`" name="transactions" label="транзакции" />
        <q-route-tab :to="`/outlets/${route.params.outlet}/reports`" name="reports" label="отчеты" />
        <q-route-tab :to="`/outlets/${route.params.outlet}/suppliers`" name="suppliers" label="поставщики" />
        <q-route-tab :to="`/outlets/${route.params.outlet}/employees`" name="employees" label="сотрудники" />
    </q-tabs>

    <div class="wrapper"><router-view></router-view></div>
</template>

<style scoped>
.wrapper {
    padding: 0 4%;
}
</style>
