<script lang="ts" setup>
const emit = defineEmits(['submit', 'cancel'])
</script>

<template>
    <q-card class="p-4">
        <q-card-section class="text-h5 text-center text-bold">
            EXIT?
        </q-card-section>

        <q-separator/>

        <q-card-section>
            Do you really want to leave?
        </q-card-section>

        <q-separator/>
        <q-card-actions align="between">
            <q-btn
                color="grey"
                label="Cancel"
                @click="emit('cancel')"
            />

            <q-btn
                class="text-bold"
                color="red"
                flat
                label="Exit" type="submit"
                @click="emit('submit')"
            />
        </q-card-actions>
    </q-card>
</template>
