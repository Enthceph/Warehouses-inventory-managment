<script lang="ts" setup>
import {useEmployeesStore} from "@/js/stores/employees";
import {AddEmployeeForm} from "@/js/types/employee.types";
import {useRolesStore} from "@/js/stores/roles";

const emit = defineEmits(['submitted', 'cancel'])

const rolesStore = useRolesStore()
const employeeStore = useEmployeesStore()

const form = ref()
const loading = ref(false)
const employee = reactive<AddEmployeeForm>({
    full_name: '',
    email: '',
    password: '',
    password_conformation: '',
    role_id: 6
})

const rolesForEmployee = computed(() => {
    if (!rolesStore.roles) return []

    return rolesStore.roles.filter((role) => {
        return role.name != 'Admin' && role.name != 'Owner'
    })
})

onMounted(() => {
    rolesStore.fetchGetRoles()
})

const submit = async () => {
    const validated = form.value.validate()
    if (!validated) return

    loading.value = true

    try {
        await employeeStore.fetchAddEmployee(employee)
    } catch (err) {
        console.log('AddEmployeeForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submitted', employee)

    await employeeStore.fetchGetEmployees()
}
const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <q-card class="q-dialog-plugin">
        <q-form ref="form" @submit.prevent="submit">
            <q-card-section>
                <h2 class="text-h5 text-center">Добавить работника</h2>
            </q-card-section>

            <q-card-section>
                <q-form ref="add_employee_form" autocomplete="off" @submit.prevent="">
                    <q-input
                        v-model="employee.full_name"
                        :rules="[v => v.length >= 2 || `Имя работника должно иметь хотя бы 2 буквы`]"
                        hide-bottom-space
                        label="Employee Name"
                        placeholder="Enter employee name"
                        required
                    />

                    <q-input
                        v-model="employee.email"
                        :rules="[val => !!val || 'Field is required']"
                        hide-bottom-space
                        label="Employee email"
                        placeholder="Enter employee email"
                        type="email"
                    />

                    <q-input
                        v-model="employee.password"
                        :rules="[val => !!val || 'Field is required']"
                        autocomplete="off"
                        hide-bottom-space
                        label="Password"
                        type="password"
                    />
                    <q-input
                        v-model="employee.password_confirmation"
                        :rules="[v => v === employee.password || `Пароли не равны`]"
                        hide-bottom-space
                        label="Repeat password"
                        type="password"
                    />

                    <q-select
                        v-model="employee.role_id"
                        :options="rolesForEmployee"
                        emit-value
                        hide-bottom-space
                        label="role"
                        map-options
                        option-label="name"
                        option-value="id"
                        options-dense
                        required
                    />
                </q-form>
            </q-card-section>

            <q-card-actions align="right">
                <q-btn color="grey" label="Отмена" @click="cancel"/>
                <q-btn color="primary" label="Добавить" type="submit"/>
            </q-card-actions>
        </q-form>
    </q-card>
</template>
