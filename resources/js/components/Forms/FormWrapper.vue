<script lang="ts" setup>
const props = defineProps<{
    loading: boolean
}>()
</script>

<template>
    <q-card class="q-dialog-plugin">
        <transition
            appear
            enter-active-class="animated fadeIn"
            leave-active-class="animated fadeOut"
        >
            <slot/>
        </transition>
        <q-inner-loading :showing="props.loading"/>
    </q-card>
</template>
