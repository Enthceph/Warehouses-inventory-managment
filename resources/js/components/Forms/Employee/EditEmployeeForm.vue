<script lang="ts" setup>
import {useEmployeesStore} from "@/js/stores/employees";
import {EmployeeForEdit} from "@/js/types/employee.types";
import {useRolesStore} from "@/js/stores/roles";

const emit = defineEmits(['submitted', 'cancel'])

const rolesStore = useRolesStore()
const employeesStore = useEmployeesStore()
const form = ref()

const employee = reactive<EmployeeForEdit>({
    id: 0,
    full_name: '',
    email: '',
    role_id: 0,
})
const rolesForEmployee = computed(() => {
    if (!rolesStore.roles) return []

    return rolesStore.roles.filter((role) => {
        return role.name != 'Admin' && role.name != 'Owner'
    })
})
const loading = ref(false)

onMounted(() => {
    Object.assign(employee, employeesStore.selectedEmployee)
    rolesStore.fetchGetRoles()
})

const submit = async () => {
    const validated = form.value.validate()
    if (!validated) return

    loading.value = true

    try {
        await employeesStore.fetchEditEmployee(employee.id, {
            id: employee.id,
            role_id: employee.role_id
        })
    } catch (err) {
        console.log('EditEmployeeForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submitted', employee)

    await employeesStore.fetchGetEmployees()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <q-card class="q-dialog-plugin">
        <transition
            appear
            enter-active-class="animated fadeIn"
            leave-active-class="animated fadeOut"
        >
            <q-form ref="form" @submit.prevent="submit">
                <q-card-section>
                    <h2 class="text-h5 text-center">Змінити інформацію про працівника</h2>
                </q-card-section>

                <q-card-section>
                    <q-form ref="add_employee_form" autocomplete="off" @submit.prevent="">
                        <q-input
                            v-model="employee.full_name"

                            hide-bottom-space
                            label="Ім'я працівника"
                            placeholder="Введіть ім'я співробітника"
                        />

                        <q-input
                            v-model="employee.email"

                            label="Електронна адреса співробітника"
                            placeholder="Edit employee email"
                        />
                        <!--                        <q-select-->
                        <!--                            v-model="employee.role_id"-->
                        <!--                            :options="rolesForEmployee"-->
                        <!--                            emit-value-->
                        <!--                            hide-bottom-space-->
                        <!--                            label="role"-->
                        <!--                            map-options-->
                        <!--                            option-label="name"-->
                        <!--                            option-value="id"-->
                        <!--                            options-dense-->
                        <!--                            required-->
                        <!--                        />-->
                    </q-form>
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn color="grey" label="Відміна" @click="cancel"/>
                    <q-btn color="primary" label="Змінити" type="submit"/>
                </q-card-actions>
            </q-form>
        </transition>
        <q-inner-loading :showing="loading"/>
    </q-card>

</template>
