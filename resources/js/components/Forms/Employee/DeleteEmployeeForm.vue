<script lang="ts" setup>
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";
import {useEmployeesStore} from "@/js/stores/employees";
import {Employee} from "@/js/types/employee.types";

const emit = defineEmits(['submit', 'cancel'])

const loading = ref(false)
const employeesStore = useEmployeesStore()

const props = defineProps<{
    employee: Employee
}>()

const submit = async () => {
    loading.value = true

    try {
        await employeesStore.fetchDeleteEmployee(props.employee.id)
    } catch (err) {
        console.log('DeleteEmployeeForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submit')

    await employeesStore.fetchGetEmployees()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper :loading="loading" action-label="Delete" title="Delete employee" @cancel="cancel" @submit="submit">
        Do you really wish to delete <b>{{ props.employee.full_name }}</b>?
    </FormWrapper>
</template>
