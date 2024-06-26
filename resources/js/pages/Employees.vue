<script lang="ts" setup>
import { useEmployeesStore } from '@/js/stores/employees'
import Table from '@/js/components/Table/Table.vue'
import AddEmployeeForm from '@/js/components/Forms/Employee/AddEmployeeForm.vue'
import UpdateEmployeeForm from '@/js/components/Forms/Employee/UpdateEmployeeForm.vue'
import DeleteEmployeeForm from '@/js/components/Forms/Employee/DeleteEmployeeForm.vue'
import { useAuthStore } from '@/js/stores/auth'

const employeeStore = useEmployeesStore()
const authStore = useAuthStore()

onMounted(() => {
    employeeStore.fetchGetEmployees()
})

const columnNames = ['id', 'Name', 'Email', 'Started working', 'Role']

const columns = computed(() => {
    return employeeStore.employees.map((employee) => {
        return {
            id: employee.id,
            full_name: employee.fullName,
            email: employee.email,
            created_at: new Date(employee.createdAt).toLocaleDateString(
                'ru-RU'
            ),
            role: employee.role.name,
        }
    })
})
</script>

<template>
    <Table
        :column-names="columnNames"
        :columns="columns"
        :data="employeeStore.employees"
        :hide-action-buttons="authStore.role !== 'Owner'"
    >
        <template v-slot:addForm="{ submit, cancel }" #addForm>
            <AddEmployeeForm @cancel="cancel" @submit="submit" />
        </template>

        <template v-slot:updateForm="{ submit, cancel, selected }" #updateForm>
            <UpdateEmployeeForm
                :employee="selected"
                @cancel="cancel"
                @submit="submit"
            />
        </template>

        <template v-slot:deleteForm="{ submit, cancel, selected }" #deleteForm>
            <DeleteEmployeeForm
                :employee="selected"
                @cancel="cancel"
                @submit="submit"
            />
        </template>
    </Table>
</template>
