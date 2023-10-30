<script lang="js" setup>
import {useDialogPluginComponent} from 'quasar'
import EditEmployeeForm from "@/js/components/Forms/EditEmployeeForm.vue";
import AddEmployeeForm from "@/js/components/Forms/AddEmployeeForm.vue";
import {useFetching} from "@/js/composables/useFetching";
import {addEmployee, editEmployee, getEmployees} from "@/api/employee";

defineEmits([...useDialogPluginComponent.emits])

const {dialogRef, onDialogHide} = useDialogPluginComponent()


onMounted(() => {
    fetchGetEmployees()
})


const {fetch: fetchGetEmployees, data: employees} = useFetching(getEmployees)
const {fetch: fetchEditEmployee} = useFetching(editEmployee)
const {fetch: fetchAddEmployee} = useFetching(addEmployee)

const showEditEmployeeModal = ref(false)
const showAddEmployeeModal = ref(false)
const selectedEmployee = ref({})

const onEditEmployeeClicked = (employee) => {
    selectedEmployee.value = employee
    showEditEmployeeModal.value = true
}

const onEditEmployeeFormSubmit = async () => {
    await fetchEditEmployee(selectedEmployee.value.id, selectedEmployee)

    await fetchGetEmployees()

    showEditEmployeeModal.value = false
}

const onAddEmployeeFormSubmit = async (employee) => {
    await fetchAddEmployee(employee)

    await fetchGetEmployees()

    showAddEmployeeModal.value = false
}


</script>

<template>
    <q-markup-table>
        <thead>
        <q-tr>
            <q-th>id</q-th>
            <q-th>first_name</q-th>
            <q-th>last_name</q-th>
            <q-th>email</q-th>
            <q-th>role</q-th>
            <q-th></q-th>
        </q-tr>
        </thead>
        <tbody>
        <q-tr v-for="employee of employees">
            <q-td>{{ employee.id }}</q-td>
            <q-td>{{ employee.first_name }}</q-td>
            <q-td>{{ employee.last_name }}</q-td>
            <q-td>{{ employee.email }}</q-td>
            <q-td>{{ employee.role }}</q-td>
            <q-td class="flex justify-around">
                <q-btn
                    color="orange"
                    icon="edit"
                    rounded
                    size="sm"
                    @click="onEditEmployeeClicked(employee)"
                />
                <q-btn
                    color="red"
                    icon="delete"
                    size="sm"
                />
            </q-td>
        </q-tr>
        </tbody>
    </q-markup-table>

    <div class="w-full mt-4 flex justify-center">
        <q-btn class="mx-auto" color="brown-6" icon="add" round @click="showAddEmployeeModal = true"/>
    </div>

    <q-dialog ref="dialogRef" v-model="showEditEmployeeModal" @hide="onDialogHide">
        <EditEmployeeForm
            :employee="selectedEmployee"
            @submit="onEditEmployeeFormSubmit"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showAddEmployeeModal" @hide="onDialogHide">
        <AddEmployeeForm
            @submit="onAddEmployeeFormSubmit"
        />
    </q-dialog>
</template>
