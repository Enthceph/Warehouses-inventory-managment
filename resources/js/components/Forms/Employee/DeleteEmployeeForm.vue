<script lang="ts" setup>
import {useEmployeesStore} from "@/js/stores/employees";

const emit = defineEmits(['submitted', 'cancel'])
const employeeStore = useEmployeesStore()
const loading = ref(false)

const submit = async () => {
    loading.value = true

    try {
        if (employeeStore.selectedEmployee) {
            await employeeStore.fetchDeleteEmployee(employeeStore.selectedEmployee.id)
        }
    } catch (err) {
        console.log('DeleteEmployeeForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submitted')

    await employeeStore.fetchGetEmployees()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <q-card>
        <transition
            appear
            enter-active-class="animated fadeIn"
            leave-active-class="animated fadeOut"
        >
            <div>
                <q-card-section>
                    Ви дійсно хочете видалити працівника {{ employeeStore.selectedEmployee.full_name }}?
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn
                        color="grey"
                        label="Відміна"
                        @click="cancel"
                    />
                    <q-btn
                        color="red"
                        label="Видалити"
                        type="submit"
                        @click="submit"
                    />
                </q-card-actions>
            </div>
        </transition>
        <q-inner-loading :showing="loading"/>
    </q-card>
</template>
