<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import TabLayout from "@/js/components/OrganisationPage/TabLayout.vue";
import TabCard from '@/js/components/OrganisationPage/TabCard.vue'
import TabAddCard from "@/js/components/OrganisationPage/TabAddCard.vue";
import AddOutletForm, {Outlet} from "@/js/components/Forms/AddOutletForm.vue";
import {useFetching} from "@/js/composables/useFetching";
import {addOutlet, getOutlets} from "@/api/outlet";

defineEmits([...useDialogPluginComponent.emits])
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const showAddOutletModal = ref(false)

const {fetch: fetchGetOutlets, data: outlets} = useFetching(getOutlets)
const {fetch: fetchAddOutlet} = useFetching(addOutlet)

const onAddOutletFormSubmit = async (data: Outlet) => {
    await fetchAddOutlet(data)

    await fetchGetOutlets()
}

onMounted(() => {
    fetchGetOutlets()
})
</script>

<template>
    <TabLayout>
        <TabCard
            v-for="outlet of outlets"
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
            @submit="onAddOutletFormSubmit"
        />
    </q-dialog>
</template>
