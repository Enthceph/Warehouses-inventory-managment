<script lang="ts" setup>
const emit = defineEmits(['submit', 'cancel'])
const props = defineProps<{
    loading: boolean,
    title: string,
    actionLabel: string
}>()
</script>

<template>
    <q-card class="q-dialog-plugin">
        <transition
            appear
            enter-active-class="animated fadeIn"
            leave-active-class="animated fadeOut"
        >
            <q-card class="q-dialog-plugin">
                <q-form ref="form" @submit.prevent="emit('submit')">
                    <q-card-section>
                        <h2 class="text-h5 text-center">{{ title }}</h2>
                    </q-card-section>

                    <q-card-section>
                        <slot/>
                    </q-card-section>

                    <q-card-actions align="right">
                        <q-btn :label="actionLabel" color="primary" type="submit"/>
                        <q-btn color="grey" label="Cancel" @click="emit('cancel')"/>
                    </q-card-actions>
                </q-form>
            </q-card>
        </transition>
        <q-inner-loading :showing="props.loading"/>
    </q-card>
</template>
