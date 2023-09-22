<script lang="ts" setup>
import { useWindowSize } from "@vueuse/core";

//Layout
let layout = computed(() => {
    const { meta } = useRoute();
    const layoutName = meta.layout ?? 'DefaultLayout';
    return defineAsyncComponent(
        () => {
            // @ts-ignore
            return import(`../layouts/${layoutName}.vue`)
        }


    );
})
const { width, height } = useWindowSize()
</script>

<template>
    <component :is="layout">
        <router-view />
    </component>
    <!-- <div class="dev top">
        {{width }} x{{height}}
    </div> -->
</template>

<style scoped></style>
