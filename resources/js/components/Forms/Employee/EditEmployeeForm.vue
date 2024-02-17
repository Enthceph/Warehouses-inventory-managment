<script lang="ts" setup>
import {useEmployeesStore} from "@/js/stores/employees";
import {EditEmployeeForm, Employee} from "@/js/types/employee.types";
import {useRolesStore} from "@/js/stores/roles";
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";

const props = defineProps<{
    employee: Employee
}>()

const emit = defineEmits(['submit', 'cancel'])

onMounted(() => {
    rolesStore.fetchGetRoles()
})

const rolesStore = useRolesStore()
const employeeStore = useEmployeesStore()

const loading = ref(false)


const employee = reactive<EditEmployeeForm>({
    id: props.employee.id,
    full_name: props.employee.full_name,
    email: props.employee.email,
    role_id: props.employee.role_id,
})

const rolesForEmployee = computed(
    () => rolesStore.roles.filter((role) => role.name != 'Admin' && role.name != 'Owner')
)

const submit = async () => {
    loading.value = true

    try {
        await employeeStore.fetchEditEmployee(employee)
    } catch (err) {
        console.log('EditEmployeeForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submit')

    await employeeStore.fetchGetEmployees()
}
const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper :loading="loading" action-label="Edit" title="Edit employee" @cancel="cancel" @submit="submit">
        <q-input
            v-model="employee.full_name"
            hide-bottom-space
            label="Employee name"
            placeholder="Enter employee name"
        />

        <q-input
            v-model="employee.email"
            label="E-mail of the employee"
            placeholder="Edit employee email"
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
    </FormWrapper>
</template>
