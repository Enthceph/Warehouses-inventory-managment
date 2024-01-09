<script lang="ts" setup>
import {Warehouse} from "@/js/stores/warehouses";

const props = defineProps<{
    warehouse: Warehouse
}>()

const emit = defineEmits(['submit', 'cancel'])

const submit = () => {
    emit('submit', props.warehouse)
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <q-card>
        <q-card-section>
            Вы действительно хотите удалить {{ props.warehouse.name }}?
        </q-card-section>

        <q-card-actions align="right">
            <q-btn
                color="grey"
                label="Отмена"
                @click="cancel"
            />
            <q-btn
                color="red"
                label="Удалить"
                type="submit"
                @click="submit"
            />
        </q-card-actions>
    </q-card>
</template>
