<script lang="js" setup>
import {useDialogPluginComponent} from 'quasar'
import EditEmployeeForm from "@/js/components/Forms/Employee/EditEmployeeForm.vue";
import AddEmployeeForm from "@/js/components/Forms/Employee/AddEmployeeForm.vue";
import {useFetching} from "@/js/composables/useFetching";
import {addEmployee, deleteEmployee, getEmployees, updateEmployee} from "@/api/employee";

defineEmits([...useDialogPluginComponent.emits])

const {dialogRef} = useDialogPluginComponent()

onMounted(() => {
    fetchGetEmployees()
})

// ADD
const showAddEmployeeModal = ref(false)
const {fetch: fetchAddEmployee} = useFetching(addEmployee)
const onAddEmployeeFormSubmit = async (employee) => {
    await fetchAddEmployee(employee)

    await fetchGetEmployees()

    showAddEmployeeModal.value = false
}

// EDIT
const showEditEmployeeModal = ref(false)
const selectedEditEmployee = ref({})
const {fetch: fetchEditEmployee} = useFetching(updateEmployee)

const onEditEmployeeClicked = (employee) => {
    selectedEditEmployee.value = employee
    showEditEmployeeModal.value = true
}

const onEditEmployeeFormSubmit = async () => {
    await fetchEditEmployee(selectedEditEmployee.value.id, selectedEditEmployee)

    await fetchGetEmployees()

    showEditEmployeeModal.value = false
}

// GET
const {fetch: fetchGetEmployees, data: employees} = useFetching(getEmployees)


// DELETE
const {fetch: fetchDeleteEmployees} = useFetching(deleteEmployee)
const showDeleteEmployeeModal = ref(false)
const selectedDeleteEmployee = ref({})

const onDeleteEmployeeClicked = async (employee) => {
    selectedDeleteEmployee.value = employee
    showDeleteEmployeeModal.value = true
}

const onDeleteEmployeeFormSubmit = async () => {
    await fetchDeleteEmployees(selectedDeleteEmployee.value.id)
    await fetchGetEmployees()

    showDeleteEmployeeModal.value = false
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
                    color="warning"
                    icon="edit"
                    rounded
                    size="sm"
                    @click="onEditEmployeeClicked(employee)"
                />
                <q-btn
                    color="red"
                    icon="delete"
                    size="sm"
                    @click="onDeleteEmployeeClicked(employee)"
                />
            </q-td>
        </q-tr>
        </tbody>
    </q-markup-table>

    <div class="w-full mt-4 flex justify-center">
        <q-btn
            class="mx-auto"
            color="brown-6"
            icon="add"
            round
            @click="showAddEmployeeModal = true"
        />
    </div>

    <!--    MODALS    -->

    <q-dialog
        ref="dialogRef"
        v-model="showEditEmployeeModal"
        @hide="showEditEmployeeModal = false"
    >
        <EditEmployeeForm
            :employee="selectedEditEmployee"
            @cancel="showEditEmployeeModal = false"
            @submit="onEditEmployeeFormSubmit"
        />
    </q-dialog>

    <q-dialog
        ref="dialogRef"
        v-model="showAddEmployeeModal"
        @hide="showAddEmployeeModal = false"
    >
        <AddEmployeeForm
            @cancel="showAddEmployeeModal = false"
            @submit="onAddEmployeeFormSubmit"
        />
    </q-dialog>

    <q-dialog
        ref="dialogRef"
        v-model="showDeleteEmployeeModal"
        @hide="showDeleteEmployeeModal = false"
    >
        <q-card class="q-dialog-plugin">
            <q-card-section>
                Вы действительно хотите удалить пользователя {{ selectedDeleteEmployee.first_name }}
                {{ selectedDeleteEmployee.last_name }}?
            </q-card-section>

            <q-card-actions align="right">
                <q-btn color="grey" label="Отмена" @click="showDeleteEmployeeModal = false"/>
                <q-btn color="red" label="Удалить" @click="onDeleteEmployeeFormSubmit"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>
