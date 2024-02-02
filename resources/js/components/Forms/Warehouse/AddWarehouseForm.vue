<script lang="ts" setup>
import {useWarehousesStore} from "@/js/stores/warehouses";
import {Warehouse} from "@/js/types/warehouse.types";

const emit = defineEmits(['submitted', 'cancel'])

const form = ref()
const warehouse = reactive<Omit<Warehouse, 'id'>>({
    name: '',
    location: '',
    contact_info: '',
})
const loading = ref(false)
const warehouseStore = useWarehousesStore()

const submit = async () => {
    const validated = form.value.validate()
    if (!validated) return

    loading.value = true

    try {
        await warehouseStore.fetchAddWarehouse(warehouse)
    } catch (err) {
        console.log('AddWarehouseForm Error', err)
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
                    <h2 class="text-h5 text-center">Додати склад</h2>
                </q-card-section>

                <q-card-section>
                    <q-form ref="add_warehouse_form" autocomplete="off" @submit.prevent="">
                        <q-input
                            v-model="warehouse.name"
                            :rules="[v => v.length >= 2 || `Назва складу повинна мати хоча б 2 літери`]"
                            hide-bottom-space
                            label="Назва складу"
                            placeholder="Введіть назву складу"
                            required
                        />

                        <q-input
                            v-model="warehouse.location"
                            label="Розташування складу"
                            placeholder="Введіть місцезнаходження складу"
                        />

                        <q-input
                            v-model="warehouse.contact_info"
                            label="Контактна інформація"
                            placeholder="Введіть контактну інформацію"
                        />
                    </q-form>
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn color="grey" label="Відміна" @click="cancel"/>
                    <q-btn color="primary" label="Додати" type="submit"/>
                </q-card-actions>
            </q-form>
        </transition>
        <q-inner-loading :showing="loading"/>
    </q-card>
</template>
