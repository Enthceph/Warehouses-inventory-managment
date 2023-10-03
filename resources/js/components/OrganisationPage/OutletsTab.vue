<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import TabLayout from "@/js/components/OrganisationPage/TabLayout.vue";
import TabCard from '@/js/components/OrganisationPage/TabCard.vue'
import TabAddCard from "@/js/components/OrganisationPage/TabAddCard.vue";

const props = defineProps({})

defineEmits([
    ...useDialogPluginComponent.emits
])

const {dialogRef, onDialogHide} = useDialogPluginComponent()


// GET
const outlets = useApi('outlet').get().json()

// ADD
const show_add_outlet_dialog = ref(false)
const add_outlet_form = ref(null)
const add_outlet_data = reactive({
    name: '',
    address: '',
    contact_info: ''
})

const add_outlet_fetch = useApi('outlet', {immediate: false}).post(add_outlet_data).json()

const fetchAddOutlet = async () => {
    // @ts-ignore
    const form_validated = await add_outlet_form.value.validate()

    if (!form_validated) return;

    add_outlet_fetch.execute()
}
add_outlet_fetch.onFetchFinally(() => {
    outlets.execute()
})
</script>

<template>
    <TabLayout>
        <TabCard
            v-for="outlet of outlets.data.value"
            :name="outlet.name"
            :to="`outlets/${outlet.id}/overview`"
        />
        <TabAddCard
            @click="show_add_outlet_dialog = true"
        />
    </TabLayout>

    <q-dialog ref="dialogRef" v-model="show_add_outlet_dialog" @hide="onDialogHide">
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
                <q-btn color="grey" label="Отмена" @click="show_add_outlet_dialog=false"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<style scoped>

</style>
