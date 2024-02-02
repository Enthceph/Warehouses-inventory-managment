<script lang="ts" setup>

</script>

<template>
    <q-list bordered class="menu">
        <router-link to="/Dashboard">
            <q-item class="flex gap-5 items-center" clickable>
                <q-icon name="dashboard"/>
                <div>Дашборд</div>
            </q-item>
        </router-link>
        <router-link to="/analytics">
            <q-item class="flex gap-5 items-center" clickable>
                <q-icon name="pie_chart"/>
                <div>Аналітика</div>
            </q-item>
        </router-link>

        <router-link to="/employees">
            <q-item class="flex gap-5 items-center" clickable>
                <q-icon name="people"/>
                <div>Робітники</div>
            </q-item>
        </router-link>

        <router-link to="/inventories">
            <q-item class="flex gap-5 items-center" clickable>
                <q-icon name="inventory"/>
                <div>Товарні запаси</div>
            </q-item>
        </router-link>

        <router-link to="/warehouses">
            <q-item class="flex gap-5 items-center" clickable>
                <q-icon name="warehouse"/>
                <div>Склади</div>
            </q-item>
        </router-link>

        <router-link to="/outlets">
            <q-item class="flex gap-5 items-center" clickable>
                <q-icon name="pin_drop"/>
                <div>Точки</div>
            </q-item>
        </router-link>

    </q-list>
</template>
<style scoped>
.menu {
    background-color: #fff;
    height:           90vh;
    position:         sticky;
    top:              20px;
}

.router-link-exact-active {
    color: #1C77FB;
}

.router-link-exact-active > .q-item {
    background-color: rgb(223 236 255);
}
</style>
