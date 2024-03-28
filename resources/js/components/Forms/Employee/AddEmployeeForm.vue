<script lang="ts" setup>
import { useEmployeesStore } from '@/js/stores/employees'
import { AddEmployeeForm } from '@/js/types/employee.types'
import { useRolesStore } from '@/js/stores/roles'
import FormWrapper from '@/js/components/Forms/FormWrapper.vue'

const emit = defineEmits(['submitted', 'cancel'])

onMounted(() => {
    rolesStore.fetchGetRoles()
})

const rolesStore = useRolesStore()
const employeeStore = useEmployeesStore()

const loading = ref(false)

const employee = reactive<AddEmployeeForm>({
    fullName: '',
    email: '',
    password: '',
    password_confirmation: '',
    roleId: 6,
})

const rolesForEmployee = computed(() => {
    if (!rolesStore.roles) return []

    return rolesStore.roles.filter((role) => {
        return role.name != 'Admin' && role.name != 'Owner'
    })
})

const submit = async () => {
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
    <FormWrapper
        :loading="loading"
        action-label="Add"
        title="Add employee"
        @cancel="cancel"
        @submit="submit"
    >
        <q-input
            v-model="employee.fullName"
            :rules="[
                (v) =>
                    v.length >= 2 ||
                    `Employee name must have at least 2 letters`,
            ]"
            hide-bottom-space
            label="Employee Name"
            placeholder="Enter employee name"
            required
        />

        <q-input
            v-model="employee.email"
            :rules="[(val) => !!val || 'Enter the employee\'s email address']"
            hide-bottom-space
            label="E-mail address of the employee"
            placeholder="Enter the employee's email address"
            type="email"
        />

        <q-input
            v-model="employee.password"
            :rules="[(val) => !!val || 'Field is required']"
            autocomplete="off"
            hide-bottom-space
            label="Password"
            type="password"
        />
        <q-input
            v-model="employee.password_confirmation"
            :rules="[
                (v) => v === employee.password || `Passwords are not equal`,
            ]"
            hide-bottom-space
            label="Repeat password"
            type="password"
        />

        <q-select
            v-model="employee.roleId"
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
    </FormWrapper>
</template>
