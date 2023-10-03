<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import TabCard from "@/js/components/OrganisationPage/TabCard.vue";
import TabLayout from "@/js/components/OrganisationPage/TabLayout.vue";
import TabAddCard from "@/js/components/OrganisationPage/TabAddCard.vue";

const props = defineProps({})

defineEmits([
    ...useDialogPluginComponent.emits
])

const {dialogRef, onDialogHide} = useDialogPluginComponent()


const warehouses = useApi('warehouse').get().json()


const show_add_warehouse_dialog = ref(false)
const add_warehouse_form = ref(null)
const add_warehouse_data = reactive({
    name: '',
    address: '',
    contact_info: ''
})

const add_warehouse_fetch = useApi('warehouse', {immediate: false}).post(add_warehouse_data).json()

const fetchAddWarehouse = async () => {
    // @ts-ignore
    const form_validated = await add_warehouse_form.value.validate()

    if (!form_validated) return;

    add_warehouse_fetch.execute()
}
add_warehouse_fetch.onFetchResponse(() => {
    warehouses.execute()
})
</script>

<template>
    <TabLayout>
        <TabCard
            v-for="warehouse of warehouses.data.value"
            :name="warehouse.name"
            :to="`warehouse/${warehouse.id}/overview`"
        />

        <TabAddCard
            @click="show_add_warehouse_dialog = true"
        />
    </TabLayout>

    <q-dialog ref="dialogRef" v-model="show_add_warehouse_dialog" @hide="onDialogHide">
        <q-card class="q-dialog-plugin">
            <q-card-section>
                <h2 class="text-h5 text-center">Добавить точку</h2>
            </q-card-section>

            <q-card-section>
                <q-form ref="add_warehouse_form" autocomplete="off" @submit.prevent="">
                    <q-input
                        v-model="add_warehouse_data.name"
                        :rules="[v => v.length >= 2 || `Название точки должно иметь хотя бы 2 буквы`]"
                        label="Warehouse name"
                        placeholder="Enter warehouse name"
                        required
                    />

                    <q-input
                        v-model="add_warehouse_data.address"
                        label="Warehouse Address"
                        placeholder="Enter warehouse address"
                    />

                    <q-input
                        v-model="add_warehouse_data.contact_info"
                        label="Contact Information"
                        placeholder="Enter contact information"
                    />
                </q-form>
            </q-card-section>

            <q-card-actions align="right">
                <q-btn color="primary" label="Добавить" @click="fetchAddWarehouse"/>
                <q-btn color="grey" label="Отмена" @click="show_add_warehouse_dialog=false"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<style scoped>

</style>
