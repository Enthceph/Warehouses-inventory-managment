<script lang="ts" setup>

export interface Employee {
    first_name: String
    last_name: String
    email: String
    password: String
    password_confirmation: String
    role: String
}

const form = ref()
const emit = defineEmits<{
    (e: 'submit', {}: Employee): void
}>()

const employee = reactive({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '',
})

const submit = async () => {
    const validated = await form.value.validate()

    if (!validated) return

    emit('submit', employee)
}
</script>

<template>
    <q-card class="q-pa-md">
        <q-form ref="form" @submit.prevent="submit">
            <q-input
                v-model="employee.first_name"
                :rules="[v => v.length >= 2 || `Имя должно иметь хотя бы 2 буквы`]"
                hide-bottom-space
                label="first_name"
                required
            />
            <q-input
                v-model="employee.last_name"
                :rules="[v => v.length >= 2 || `Фамилия должна иметь хотя бы 2 буквы`]"
                hide-bottom-space
                label="last_name"
                required
            />
            <q-input
                v-model="employee.email"
                :rules="[v => v.length >= 1 || `Введите email`]"
                hide-bottom-space
                label="email"
                required
                type="email"
            />
            <q-input
                v-model="employee.password"
                autocomplete="off"
                label="Password"
                required
                type="password"
            />
            <q-input
                v-model="employee.password_confirmation"
                :rules="[v => v === employee.password || `Пароли не равны`]"
                hide-bottom-space
                label="Repeat password"
                required
                type="password"

            />
            <q-select
                v-model="employee.role"
                :options="[
                        'Administrator',
                        'Auditor',
                        'Accountant',
                        'Manager',
                        'Employee'
                    ]"
                :rules="[v => !!v || `Роль должна быть выбрана`]"
                label="role"
                required
            />
        </q-form>
        <q-card-actions align="between" class="buttons">
            <q-btn color="grey" label="Cancel"/>
            <q-btn color="orange" label="Add" padding="6px 16px" @click="submit"/>
        </q-card-actions>
    </q-card>

</template>
<style scoped>


</style>
