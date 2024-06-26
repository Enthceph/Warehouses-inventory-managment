<script lang="ts" setup>
import { useOutletsStore } from '@/js/stores/outlets'
import AddOutletForm from '@/js/components/Forms/Outlet/AddOutletForm.vue'
import Table from '@/js/components/Table/Table.vue'
import UpdateOutletForm from '@/js/components/Forms/Outlet/UpdateOutletForm.vue'
import DeleteOutletForm from '@/js/components/Forms/Outlet/DeleteOutletForm.vue'
import { useAuthStore } from '@/js/stores/auth'

const outletStore = useOutletsStore()
const authStore = useAuthStore()

onMounted(() => {
    outletStore.fetchGetOutlets()
})

const columnNames = [
    'id',
    'Name',
    'Address',
    'Contact info',
    'Warehouse',
    'Created',
]

const columns = computed(() => {
    return outletStore.outlets.map((outlet) => {
        return {
            id: outlet.id,
            name: outlet.name,
            address: outlet.address,
            contact_info: outlet.contactInfo,
            warehouse: outlet.warehouse.name,
            createdAt: outlet.createdAt
                ? new Date(outlet.createdAt).toLocaleDateString('ru-RU')
                : null,
        }
    })
})
</script>

<template>
    <Table
        :column-names="columnNames"
        :columns="columns"
        :data="outletStore.outlets"
        :hide-action-buttons="authStore.role !== 'Owner'"
    >
        <template v-slot:addForm="{ submit, cancel }" #addForm>
            <AddOutletForm @cancel="cancel" @submit="submit" />
        </template>

        <template v-slot:updateForm="{ submit, cancel, selected }" #updateForm>
            <UpdateOutletForm
                :outlet="selected"
                @cancel="cancel"
                @submit="submit"
            />
        </template>

        <template v-slot:deleteForm="{ submit, cancel, selected }" #deleteForm>
            <DeleteOutletForm
                :outlet="selected"
                @cancel="cancel"
                @submit="submit"
            />
        </template>
    </Table>
</template>
