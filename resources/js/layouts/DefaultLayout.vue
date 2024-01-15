<script lang="ts" setup>
import TheHeader from '../components/TheHeader.vue'
import TheMenu from "@/js/components/TheMenu.vue";</script>

<template>
    <q-ajax-bar/>
    <div class="default-layout">
        <the-header class="header"/>
        <the-menu class="menu"/>
        <div class="page">
            <slot/>
        </div>
    </div>
</template>

<style scoped>

.default-layout {
    display:               grid;
    grid-template-columns: 200px 1fr;
    grid-template-rows:    70px 1fr;
}

.header {grid-area: 1 / 1 / 2 / 5;}

.menu {
    grid-area: 2 / 1 / 3 / 2;
}

.page {
    grid-area: 2 / 2 / 3 / 5;
    padding:   12px;
}

</style>
