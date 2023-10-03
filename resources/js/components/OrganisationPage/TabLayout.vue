<script lang="ts" setup>

</script>

<template>
    <div class="tab-layout">
        <slot></slot>
    </div>
</template>

<style scoped>
.tab-layout {
    display:   flex;
    flex-wrap: wrap;
    gap:       28px;
}
</style>
