<script lang="ts" setup>
import MenuLink from "@/js/components/MenuLink.vue";
</script>

<template>
    <q-list bordered class="menu">
        <MenuLink icon="view_quilt" label="Dashboard" link="Dashboard"/>
        <MenuLink icon="pie_chart" label="Analytics" link="analytics"/>
        <MenuLink icon="people" label="Employees" link="employees"/>
        <MenuLink icon="inventory" label="Inventories" link="inventories"/>
        <MenuLink icon="warehouse" label="Warehouses" link="warehouses"/>
        <MenuLink icon="pin_drop" label="Outlets" link="outlets"/>
        <MenuLink icon="view_in_ar" label="Products" link="products"/>
        <MenuLink icon="folder_open" label="Product categories" link="productCategories"/>
    </q-list>
</template>
<style scoped>
.menu {
    background-color: #fff;
    height:           90vh;
    position:         sticky;
    top:              20px;
}

</style>
