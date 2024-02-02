<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import {useOutletsStore} from "@/js/stores/outlets";
import AddOutletForm from "@/js/components/Forms/Outlet/AddOutletForm.vue";
import Table from "@/js/components/Table/Table.vue";
import {Outlet} from "@/js/types/outlet.types";
import EditOutletForm from "@/js/components/Forms/Outlet/EditOutletForm.vue";
import DeleteOutletForm from "@/js/components/Forms/Outlet/DeleteOutletForm.vue";

defineEmits([...useDialogPluginComponent.emits]);
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const router = useRouter()
const route = useRoute()
const outletStore = useOutletsStore()

const showAddOutletModal = ref(false)
const showEditOutletModal = ref(false)
const showDeleteOutletModal = ref(false)

onMounted(() => {
    outletStore.fetchGetOutlets()
})

// TABLE EMITS
const onRowAdd = () => {
    showAddOutletModal.value = true
}

const onRowEdit = (row: Outlet) => {
    outletStore.selectedOutlet = row
    showEditOutletModal.value = true
}

const onRowDelete = (row: Outlet) => {
    outletStore.selectedOutlet = row
    showDeleteOutletModal.value = true
}

const onRowClicked = (row: Outlet) => {
    router.push(`/outlets/${row.id}`)
}

const columnNames = [
    'id',
    'Назва',
    'Місцезнаходження',
    'Контактна інформація',
    'Склад',
    'Був створений'
]

"2024-01-21T13:29:17.000000Z"
const tableData = computed(() => {
    return outletStore.outlets.map((outlet) => {
        return {
            id: outlet.id,
            name: outlet.name,
            address: outlet.address,
            contact_info: outlet.contact_info,
            warehouse: outlet.warehouse.name,
            created_at: new Date(outlet.created_at).toLocaleDateString('ru-RU'),
        }
    })
})
</script>

<template>
    <Table
        :column-names="columnNames"
        :data="tableData"
        @rowAdd="onRowAdd"
        @rowClicked="onRowClicked"
        @rowDelete="onRowDelete"
        @rowEdit="onRowEdit"
    />

    <!--    MODALS    -->

    <q-dialog ref="dialogRef" v-model="showAddOutletModal" @hide="onDialogHide">
        <AddOutletForm
            @cancel="showAddOutletModal = false"
            @submitted="showAddOutletModal = false"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showEditOutletModal" @hide="onDialogHide">
        <EditOutletForm
            @cancel="showEditOutletModal = false"
            @submitted="showEditOutletModal = false"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showDeleteOutletModal" @hide="onDialogHide">
        <DeleteOutletForm
            @cancel="showDeleteOutletModal = false"
            @submitted="showDeleteOutletModal = false"
        />
    </q-dialog>
</template>
