<script lang="ts" setup></script>

<template>
    <div class="center-layout">
        <slot/>
    </div>
</template>

<style scoped>
.center-layout {
    display:     grid;
    min-height:  100vh;
    place-items: center;
    width:       100%;
}
</style>
