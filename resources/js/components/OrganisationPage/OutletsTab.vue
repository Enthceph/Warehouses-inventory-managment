<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import TabLayout from "@/js/components/OrganisationPage/TabLayout.vue";
import TabCard from '@/js/components/OrganisationPage/TabCard.vue'
import TabAddCard from "@/js/components/OrganisationPage/TabAddCard.vue";
import AddOutletForm, {Outlet} from "@/js/components/Forms/AddOutletForm.vue";

defineEmits([...useDialogPluginComponent.emits])
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const outlets = useApi('outlet').get().json()

const showAddOutletModal = ref(false)
const fetchAddOutlet = (data: Outlet) => {
    const addOutletFetch = useApi('outlet', {immediate: false}).post(data).json()

    addOutletFetch.execute().then(() => {
        outlets.execute()
    })
}
</script>

<template>
    <TabLayout>
        <TabCard
            v-for="outlet of outlets.data.value"
            :name="outlet.name"
            :to="`outlet/${outlet.id}/overview`"
        />
        <TabAddCard
            @click="showAddOutletModal = true"
        />
    </TabLayout>

    <q-dialog ref="dialogRef" v-model="showAddOutletModal" @hide="onDialogHide">
        <AddOutletForm
            @cancel="showAddOutletModal = false"
            @submit="fetchAddOutlet"
        />
    </q-dialog>
</template>

<style scoped>

</style>
