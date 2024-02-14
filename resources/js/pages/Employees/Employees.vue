<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import {useEmployeesStore} from "@/js/stores/employees";
import Table from "@/js/components/Table/Table.vue";
import {Employee} from "@/js/types/employee.types";
import AddEmployeeForm from "@/js/components/Forms/Employee/AddEmployeeForm.vue";
import EditEmployeeForm from "@/js/components/Forms/Employee/EditEmployeeForm.vue";
import DeleteEmployeeForm from "@/js/components/Forms/Employee/DeleteEmployeeForm.vue";
import {useAuthStore} from "@/js/stores/auth";

defineEmits([...useDialogPluginComponent.emits]);
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const router = useRouter()
const route = useRoute()

const employeeStore = useEmployeesStore()
const authStore = useAuthStore()

const showAddEmployeeModal = ref(false)
const showEditEmployeeModal = ref(false)
const showDeleteEmployeeModal = ref(false)

onMounted(() => {
    employeeStore.fetchGetEmployees()
})

// TABLE EMITS
const onRowAdd = () => {
    showAddEmployeeModal.value = true
}

const onRowEdit = (row: Employee) => {
    employeeStore.selectedEmployee = row
    showEditEmployeeModal.value = true
}

const onRowDelete = (row: Employee) => {
    employeeStore.selectedEmployee = row
    showDeleteEmployeeModal.value = true
}

const onRowClicked = (row: Employee) => {
    router.push(`/employees/${row.id}`)
}

const columnNames = [
    'id',
    'Name',
    'Email',
    'Started working',
    "Role",
]

const tableData = computed(() => {
    return employeeStore.employees.map((employee) => {
        return {
            id: employee.id,
            full_name: employee.full_name,
            email: employee.email,
            created_at: new Date(employee.created_at).toLocaleDateString('ru-RU'),
            role: employee.role.name,
        }
    })
})
</script>

<template>
    <Table
        :column-names="columnNames"
        :data="tableData"
        :hide-action-buttons="authStore.role !== 'Owner'"
        @rowAdd="onRowAdd"
        @rowClicked="onRowClicked"
        @rowDelete="onRowDelete"
        @rowEdit="onRowEdit"
    />

    <!--    MODALS    -->

    <q-dialog ref="dialogRef" v-model="showAddEmployeeModal" @hide="onDialogHide">
        <AddEmployeeForm
            @cancel="showAddEmployeeModal = false"
            @submitted="showAddEmployeeModal = false"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showEditEmployeeModal" @hide="onDialogHide">
        <EditEmployeeForm
            @cancel="showEditEmployeeModal = false"
            @submitted="showEditEmployeeModal = false"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showDeleteEmployeeModal" @hide="onDialogHide">
        <DeleteEmployeeForm
            @cancel="showDeleteEmployeeModal = false"
            @submitted="showDeleteEmployeeModal = false"
        />
    </q-dialog>
</template>
