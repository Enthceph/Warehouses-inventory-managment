<script lang="ts" setup>
import {useWarehousesStore} from "@/js/stores/warehouses";

const emit = defineEmits(['submitted', 'cancel'])
const warehouseStore = useWarehousesStore()
const loading = ref(false)

const submit = async () => {
    loading.value = true

    try {
        if (warehouseStore.selectedWarehouse) {
            await warehouseStore.fetchDeleteWarehouse(warehouseStore.selectedWarehouse.id)
        }
    } catch (err) {
        console.log('DeleteWarehouseForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submitted')

    await warehouseStore.fetchGetWarehouses()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <q-card>
        <transition
            appear
            enter-active-class="animated fadeIn"
            leave-active-class="animated fadeOut"
        >
            <div>
                <q-card-section>
                    Вы действительно хотите удалить склад {{ warehouseStore.selectedWarehouse.name }}?
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
            </div>
        </transition>
        <q-inner-loading :showing="loading"/>
    </q-card>
</template>
