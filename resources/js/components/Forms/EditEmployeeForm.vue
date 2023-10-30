<script lang="ts" setup>
const form = ref()
const emit = defineEmits<{
    (e: 'submit'): void
}>()

const props = defineProps({
    employee: Object
})

const submit = () => {
    const validated = form.value.validate()

    if (!validated) return

    emit('submit')
}
</script>

<template>
    <q-card class="q-pa-md">
        <q-form ref="form" @submit.prevent="submit">
            <q-input
                v-model="props.employee.first_name"
                :rules="[v => v.length >= 2 || `Имя должно иметь хотя бы 2 буквы`]"
                label="first_name"
            />
            <q-input
                v-model="props.employee.last_name"
                :rules="[v => v.length >= 2 || `Фамилия должна иметь хотя бы 2 буквы`]"
                label="last_name"/>
            <q-select
                v-model="props.employee.role"
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

        <q-card-actions align="between">
            <q-btn color="grey" label="Cancel"/>
            <q-btn color="orange" label="Edit" type="submit"/>
        </q-card-actions>
    </q-card>
</template>
