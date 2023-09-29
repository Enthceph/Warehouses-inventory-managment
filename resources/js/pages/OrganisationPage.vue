<script lang="ts" setup>
import OrgCard from "@/js/components/OrgCard.vue";
import OrgAddCard from "@/js/components/OrgAddCard.vue";

import {useDialogPluginComponent} from 'quasar'

const props = defineProps({})

defineEmits([
    ...useDialogPluginComponent.emits
])

const {dialogRef, onDialogHide, onDialogOK, onDialogCancel} = useDialogPluginComponent()

// GET
const outlets = useApi('outlet').get().json()

// ADD
const showAddOutletDialog = ref(false)
const add_outlet_form = ref(null)
const add_outlet_data = reactive({
    name: '',
    address: '',
    contact_info: ''
})

const add_outlet = useApi('outlet', {immediate: false}).post(add_outlet_data).json()

const fetchAddOutlet = async () => {
    // @ts-ignore
    const form_validated = await add_outlet_form.value.validate()

    if (!form_validated) return;

    add_outlet.execute()
}
add_outlet.onFetchFinally(() => {
    outlets.execute()
})
const tab = ref('outlets')
</script>

<template>
    <q-tabs
        v-model="tab"
        active-color="primary"
        align="justify"
        class="bg-grey-2"

    >
        <q-tab label="outlets" name="outlets"/>
        <q-tab label="warehouses" name="warehouses"/>
        <q-tab label="employees" name="employees"/>
        <q-tab label="transactions" name="transactions"/>
    </q-tabs>

    <q-tab-panels v-model="tab" animated class="">
        <q-tab-panel name="outlets">
            <div class="grid">
                <org-card
                    v-for="outlet of outlets.data.value"
                    :outlet="outlet"
                />
                <org-add-card
                    @click="showAddOutletDialog = true"
                />
            </div>
        </q-tab-panel>

        <q-tab-panel name="warehouses">


        </q-tab-panel>

        <q-tab-panel name="employees">

        </q-tab-panel>

        <q-tab-panel name="transactions">

        </q-tab-panel>
    </q-tab-panels>


    <q-dialog ref="dialogRef" v-model="showAddOutletDialog" @hide="onDialogHide">
        <q-card class="q-dialog-plugin">
            <q-card-section>
                <h2 class="text-h5 text-center">Добавить точку</h2>
            </q-card-section>

            <q-card-section>
                <q-form ref="add_outlet_form" autocomplete="off" @submit.prevent="">
                    <q-input
                        v-model="add_outlet_data.name"
                        :rules="[v => v.length >= 2 || `Название точки должно иметь хотя бы 2 буквы`]"
                        label="Outlet Name"
                        placeholder="Enter outlet name"
                        required
                    />

                    <q-input
                        v-model="add_outlet_data.address"
                        label="Outlet Address"
                        placeholder="Enter outlet address"
                    />

                    <q-input
                        v-model="add_outlet_data.contact_info"
                        label="Contact Information"
                        placeholder="Enter contact information"
                    />
                </q-form>
            </q-card-section>

            <q-card-actions align="right">
                <q-btn color="primary" label="Добавить" @click="fetchAddOutlet"/>
                <q-btn color="grey" label="Отмена" @click="showAddOutletDialog=false"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<style scoped>
.grid {
    display:               grid;
    grid-column-gap:       32px;
    grid-row-gap:          32px;
    grid-template-columns: repeat(7, 1fr);
    grid-template-rows: repeat(7, 1fr);
}
</style>
