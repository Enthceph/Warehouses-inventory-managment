<script lang="ts" setup>
import {useOutletsStore} from "@/js/stores/outlets";
import {OutletForEdit} from "@/js/types/outlet.types";
import {useWarehousesStore} from "@/js/stores/warehouses";

const emit = defineEmits(['submitted', 'cancel'])

const outletsStore = useOutletsStore()
const warehousesStore = useWarehousesStore()
const form = ref()

const outlet = reactive<OutletForEdit>({
    id: 0,
    name: '',
    address: '',
    contact_info: '',
    warehouse_id: 0,
})

const loading = ref(false)

onMounted(() => {
    Object.assign(outlet, outletsStore.selectedOutlet)
    warehousesStore.fetchGetWarehouses()
})

const submit = async () => {
    const validated = form.value.validate()
    if (!validated) return

    loading.value = true
    try {
        await outletsStore.fetchEditOutlet(outlet.id, outlet)
    } catch (err) {
        console.log('EditOutletForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submitted', outlet)

    await outletsStore.fetchGetOutlets()
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
                    <h2 class="text-h5 text-center">Изменить точку</h2>
                    {{ outlet }}
                </q-card-section>

                <q-card-section>
                    <q-form ref="add_outlet_form" autocomplete="off" @submit.prevent="">
                        <q-input
                            v-model="outlet.name"
                            :rules="[v => v.length >= 2 || `Название точки должно иметь хотя бы 2 буквы`]"
                            hide-bottom-space
                            label="Outlet name"
                            placeholder="Enter outlet name"
                            required
                        />

                        <q-input
                            v-model="outlet.location"
                            label="Outlet Location"
                            placeholder="Enter outlet location"
                        />

                        <q-input
                            v-model="outlet.contact_info"
                            label="Contact Information"
                            placeholder="Enter contact information"
                        />

                        <q-select
                            v-model="outlet.warehouse_id"
                            :options="warehousesStore.warehouses"
                            emit-value
                            label="Warehouse"
                            map-options
                            option-label="name"
                            option-value="id"
                            options-dense
                        />
                    </q-form>
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn color="grey" label="Отмена" @click="cancel"/>
                    <q-btn color="primary" label="Изменить" type="submit"/>
                </q-card-actions>
            </q-form>
        </transition>
        <q-inner-loading :showing="loading"/>
    </q-card>

</template>
