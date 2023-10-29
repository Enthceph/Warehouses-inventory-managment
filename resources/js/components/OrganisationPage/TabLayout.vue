<script lang="ts" setup>
//TODO на разных разрешениях карточки оч плохо скейлятся
</script>

<template>
    <div class="tab-layout">
        <slot/>
    </div>
</template>

<style scoped>
.tab-layout {
    display:   flex;
    flex-wrap: wrap;
    gap:       28px;
}
</style>
