<script lang="ts" setup>

let layout = computed(() => {
    const {meta} = useRoute();
    const layoutName = meta.layout ?? 'DefaultLayout';
    return defineAsyncComponent(
        () => {
            // @ts-ignore
            return import(`../layouts/${layoutName}.vue`)
        }
    );
})

</script>

<template>
    <component :is="layout">
        <router-view/>
    </component>
</template>

<style scoped></style>
