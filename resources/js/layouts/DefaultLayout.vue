<script lang="ts" setup>
import TheHeader from '../components/TheHeader.vue'</script>

<template>
    <div class="default-layout">
        <the-header class="header"/>
        <div class="page">
            <slot/>
        </div>
    </div>
</template>

<style scoped>

.default-layout {
    display:               grid;
    grid-template-columns: max-content 1fr;
    grid-template-rows:    100px 1fr;
}

.header {grid-area: 1 / 2 / 2 / 3;}

.page {
    grid-area: 2 / 2 / 3 / 3;
    padding:   12px;
}
</style>
