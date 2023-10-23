<script lang="js" setup>
import {useDialogPluginComponent, useQuasar} from 'quasar'
import EditEmployeeForm from "@/js/components/Forms/EditEmployeeForm.vue";
import AddEmployeeForm from "@/js/components/Forms/AddEmployeeForm.vue";

defineEmits([
    ...useDialogPluginComponent.emits
])

const {dialogRef, onDialogHide} = useDialogPluginComponent()
const $q = useQuasar()

//get-------------------------------------

const employees = useApi('employee', {
    immediate: false
}).get().json()
employees.execute()

//edit-------------------------------------------

const editDialogIsVisible = ref(false)
const editableEmployee = ref({})

const showEditDialog = (employee) => {
    editableEmployee.value = employee
    editDialogIsVisible.value = true
}

const fetchEditEmployee = async () => {

    const edit_employee = useApi(`employee/${editableEmployee.value.id}`, {
        immediate: false
    }).patch(editableEmployee).json()

    edit_employee.execute()
    employees.execute()
}

// add-----------------------------------------

const showAddDialog = ref(false)

const fetchAddEmployee = (employee) => {
    const add_employee = useApi(`employee`, {
        immediate: false
    }).post(employee).json()

    add_employee.execute()
    employees.execute()
    showAddDialog.value = false
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
        <q-tr v-for="employee of employees.data.value">
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
                    @click="showEditDialog(employee)"
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
        <q-btn class="mx-auto" color="brown-6" icon="add" round @click="showAddDialog = true"/>
    </div>

    <q-dialog ref="dialogRef" v-model="editDialogIsVisible" @hide="onDialogHide">
        <EditEmployeeForm
            :employee="editableEmployee"
            @submit="fetchEditEmployee"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showAddDialog" @hide="onDialogHide">
        <AddEmployeeForm
            @submit="fetchAddEmployee"
        />
    </q-dialog>
</template>

<style scoped>

</style>
