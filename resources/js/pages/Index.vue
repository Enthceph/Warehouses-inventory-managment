<script lang="ts" setup>
import DefaultLayout from '../layouts/DefaultLayout.vue'

let layout = computed(() => {
    const { meta } = useRoute()
    return meta.layout ?? DefaultLayout
})
</script>

<template>
    <component :is="layout">
        <router-view />
    </component>
</template>
