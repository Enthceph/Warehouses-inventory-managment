<script lang="js" setup>
import {useDialogPluginComponent, useQuasar} from 'quasar'

defineEmits([
    ...useDialogPluginComponent.emits
])

const {dialogRef, onDialogHide} = useDialogPluginComponent()
const $q = useQuasar()
//get
const employees = useApi('employee', {
    immediate: false
}).get().json()
employees.execute()
//edit
const show_edit_dialog = ref(false)
const edit_employee_form = ref(null)
const editable_employee = ref({})

const showEditDialog = (employee) => {
    editable_employee.value = employee
    show_edit_dialog.value = true
}

const fetchEditEmployee = async () => {
    if(!await edit_employee_form.value.validate()) return;
    const edit_employee = useApi(`employee/${editable_employee.value.id}`, {
        immediate: false
    }).patch(editable_employee).json()

    edit_employee.execute()
    employees.execute()
}

// add
const add_employee_form = ref(null)
const show_add_dialog = ref(false)
const add_employee_data = reactive({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    role: ''
})
const fetchAddEmployee = async () => {
    if(!await add_employee_form.value.validate()) return;

    const add_employee = useApi(`employee`, {
        immediate: false
    }).post(add_employee_data).json()
    add_employee.execute()
    // employees.execute()
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
        <q-btn class="mx-auto" color="brown-6" icon="add" round @click="show_add_dialog = true"/>
    </div>

    <q-dialog ref="dialogRef" v-model="show_edit_dialog" @hide="onDialogHide">
        <q-card class="q-pa-md">

            <q-form ref="edit_employee_form" @submit.prevent>
                <q-input
                    v-model="editable_employee.first_name"
                    :rules="[v => v.length >= 2 || `Имя должно иметь хотя бы 2 буквы`]"
                    label="first_name"
                />
                <q-input
                    v-model="editable_employee.last_name"
                    :rules="[v => v.length >= 2 || `Фамилия должна иметь хотя бы 2 буквы`]"
                    label="last_name"/>
                <q-select
                    v-model="editable_employee.role"
                    :options="[
                        'Auditor',
                        'Accountant',
                        'Manager',
                        'Employee'
                    ]"
                    :rules="[v => !!v || `Роль должна быть выбрана`]"
                    label="role"
                />
            </q-form>


            <q-card-actions align="right">
                <q-btn color="orange" label="Edit" @click="fetchEditEmployee"/>
                <q-btn v-close-popup color="grey" label="Cancel"/>
            </q-card-actions>

        </q-card>
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="show_add_dialog" @hide="onDialogHide">
        <q-card class="q-pa-md">

            <q-form ref="add_employee_form" @submit.prevent>
                <q-input
                    v-model="add_employee_data.first_name"
                    :rules="[v => v.length >= 2 || `Имя должно иметь хотя бы 2 буквы`]"
                    label="first_name"
                />
                <q-input
                    v-model="add_employee_data.last_name"
                    :rules="[v => v.length >= 2 || `Фамилия должна иметь хотя бы 2 буквы`]"
                    label="last_name"/>
                <q-input
                    v-model="add_employee_data.email"
                    :rules="[v => v.length >= 1 || `Введите email`]"
                    label="email"
                    type="email"
                />
                <q-input v-model="add_employee_data.password" autocomplete="off" label="Password" required
                         type="password"/>
                <q-input v-model="add_employee_data.password_confirmation"
                         :rules="[v => v === add_employee_data.password || `Пароли не равны`]"
                         hide-bottom-space
                         label="Repeat password"
                         required
                         type="password"/>
                <q-select
                    v-model="add_employee_data.role"
                    :options="[
                        'Administrator',
                        'Auditor',
                        'Accountant',
                        'Manager',
                        'Employee'
                    ]"
                    :rules="[v => !!v || `Роль должна быть выбрана`]"
                    label="role"
                />
            </q-form>


            <q-card-actions align="right">
                <q-btn color="orange" label="Edit" @click="fetchAddEmployee"/>
                <q-btn v-close-popup color="grey" label="Cancel"/>
            </q-card-actions>

        </q-card>
    </q-dialog>
</template>

<style scoped>

</style>
