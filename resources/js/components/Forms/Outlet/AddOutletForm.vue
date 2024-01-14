<script lang="ts" setup>
import {useOutletsStore} from "@/js/stores/outlets";
import {OutletFormData} from "@/js/types/outlet.types";

const emit = defineEmits(['submitted', 'cancel'])

const form = ref()
const outlet = reactive<OutletFormData>({
    name: '',
    address: '',
    contact_info: '',
    outlet_name: ''
})

const loading = ref(false)
const outletStore = useOutletsStore()

const submit = async () => {
    const validated = form.value.validate()
    if (!validated) return

    loading.value = true

    try {
        await outletStore.fetchAddOutlet(outlet)
    } catch (err) {
        console.log('AddOutletForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submitted', outlet)

    await outletStore.fetchGetOutlets()
}
const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <q-card class="q-dialog-plugin">
        <q-form ref="form" @submit.prevent="submit">
            <q-card-section>
                <h2 class="text-h5 text-center">Добавить точку</h2>
            </q-card-section>

            <q-card-section>
                <q-form ref="add_outlet_form" autocomplete="off" @submit.prevent="">
                    <q-input
                        v-model="outlet.name"
                        :rules="[v => v.length >= 2 || `Название точки должно иметь хотя бы 2 буквы`]"
                        hide-bottom-space
                        label="Outlet Name"
                        placeholder="Enter outlet name"
                        required
                    />

                    <q-input
                        v-model="outlet.address"
                        label="Outlet Address"
                        placeholder="Enter outlet address"
                    />

                    <q-input
                        v-model="outlet.contact_info"
                        label="Contact Information"
                        placeholder="Enter contact information"
                    />

                    <q-input
                        v-model="outlet.outlet_name"
                        :placeholder="outlet.name + 'outlet'"
                        label="Warehouse name(not required)"
                    />
                </q-form>
            </q-card-section>

            <q-card-actions align="right">
                <q-btn color="primary" label="Добавить" type="submit"/>
                <q-btn color="grey" label="Отмена" @click="cancel"/>
            </q-card-actions>
        </q-form>
    </q-card>
</template>
