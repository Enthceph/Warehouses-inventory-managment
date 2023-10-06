<script lang="ts" setup>
import OutletsTab from "@/js/components/OrganisationPage/OutletsTab.vue";
import WarehousesTab from "@/js/components/OrganisationPage/WarehousesTab.vue";
import EmployeesTab from "@/js/components/OrganisationPage/EmployeesTab.vue";


const tab = ref('employees')
</script>

<template>
    <q-tabs
        v-model="tab"
        active-color="primary"
        align="justify"
        class="bg-grey-2"

    >
        <q-tab label="outlets" name="outlets"/>
        <q-tab label="warehouses" name="warehouses"/>
        <q-tab label="employees" name="employees"/>
        <q-tab label="transactions" name="transactions"/>
    </q-tabs>

    <q-tab-panels v-model="tab" animated class="">
        <q-tab-panel name="outlets">
            <OutletsTab/>
        </q-tab-panel>

        <q-tab-panel name="warehouses">
            <WarehousesTab/>
        </q-tab-panel>

        <q-tab-panel name="employees">
            <EmployeesTab/>
        </q-tab-panel>

        <q-tab-panel name="transactions">

        </q-tab-panel>
    </q-tab-panels>


</template>

<style scoped>
</style>
