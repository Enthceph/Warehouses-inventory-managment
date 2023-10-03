<script lang="ts" setup>
const props = defineProps<{
    'to'?: string,
    'name': string
}>()

</script>

<template>
    <router-link :to="props.to" class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/6 aspect-square">
        <q-card class="flex-center h-full">
            {{ props.name }}
        </q-card>
    </router-link>
</template>

<style scoped>

</style>
