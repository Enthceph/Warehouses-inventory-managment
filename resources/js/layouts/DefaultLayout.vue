<script lang="ts" setup>
import TheHeader from '../components/TheHeader.vue'
import TheMenu from '@/js/components/TheMenu.vue'
</script>

<template>
    <div class="default-layout">
        <the-header class="header" />
        <the-menu class="menu" />
        <div class="page">
            <slot />
        </div>
    </div>
</template>

<style scoped>
.default-layout {
    display: grid;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
    grid-template-columns: 250px 1fr;
    grid-template-rows: 100px 1fr;
}

.header {
    grid-area: 1 / 1 / 2 / 3;
}

.menu {
    grid-area: 2 / 1 / 3 / 2;
}

.page {
    grid-area: 2 / 2 / 3 / 3;
    padding: 12px;
}
</style>
