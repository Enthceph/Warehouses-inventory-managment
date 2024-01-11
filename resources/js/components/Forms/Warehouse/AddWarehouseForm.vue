<script lang="ts" setup>
import {useWarehouseStore, WarehouseWithoutId} from "@/js/stores/warehouses";

const emit = defineEmits(['submitted', 'cancel'])

const form = ref()
const warehouse = reactive<WarehouseWithoutId>({
    name: '',
    location: '',
    contact_info: '',
})
const loading = ref(false)
const warehouseStore = useWarehouseStore()

const submit = async () => {
    const validated = form.value.validate()
    if (!validated) return

    loading.value = true

    try {
        await warehouseStore.fetchAddWarehouse(warehouse)
    } catch (err) {
        console.log('Add Warehouse Form Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submitted', warehouse)

    await warehouseStore.fetchGetWarehouses()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <q-card class="q-dialog-plugin">
        <transition
            appear
            enter-active-class="animated fadeIn"
            leave-active-class="animated fadeOut"
        >
            <q-form ref="form" @submit.prevent="submit">
                <q-card-section>
                    <h2 class="text-h5 text-center">Добавить склад</h2>
                </q-card-section>

                <q-card-section>
                    <q-form ref="add_warehouse_form" autocomplete="off" @submit.prevent="">
                        <q-input
                            v-model="warehouse.name"
                            :rules="[v => v.length >= 2 || `Название склада должно иметь хотя бы 2 буквы`]"
                            hide-bottom-space
                            label="Warehouse name"
                            placeholder="Enter warehouse name"
                            required
                        />

                        <q-input
                            v-model="warehouse.location"
                            label="Warehouse Location"
                            placeholder="Enter warehouse location"
                        />

                        <q-input
                            v-model="warehouse.contact_info"
                            label="Contact Information"
                            placeholder="Enter contact information"
                        />
                    </q-form>
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn color="grey" label="Отмена" @click="cancel"/>
                    <q-btn color="primary" label="Добавить" type="submit"/>
                </q-card-actions>
            </q-form>
        </transition>
        <q-inner-loading :showing="loading"/>
    </q-card>
</template>
