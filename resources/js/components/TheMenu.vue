<script lang="ts" setup>

</script>

<template>
    <q-list bordered>
        <q-item clickable>
            <q-item-section>
                <router-link to="/dashboard">Dashboard</router-link>
            </q-item-section>
        </q-item>
        <q-item clickable>
            <q-item-section>
                <router-link to="/analytics">Analytics</router-link>
            </q-item-section>
        </q-item>
        <q-item clickable>
            <q-item-section>
                <router-link to="/employees">Employees</router-link>
            </q-item-section>
        </q-item>

        <q-item clickable>
            <q-item-section>
                <router-link to="/inventories">Inventories</router-link>
            </q-item-section>
        </q-item>
        <q-item clickable>
            <q-item-section>
                <router-link to="/warehouses">Warehouses</router-link>
            </q-item-section>
        </q-item>
        <q-item clickable>
            <q-item-section>
                <router-link to="/outlets">Outlets</router-link>
            </q-item-section>
        </q-item>
    </q-list>
</template>
