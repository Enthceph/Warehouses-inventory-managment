<script lang="ts" setup>
import {updateCompany} from "@/api/company";
import {useCompanyStore} from "@/js/stores/company";

const emit = defineEmits(['submitted'])

const companyStore = useCompanyStore()
const formData = reactive({
    name: ''
})
const loading = ref(false)


onMounted(async () => {
    loading.value = true

    await companyStore.fetchCompany()
    formData.name = companyStore.name

    loading.value = false
})

const submit = async () => {
    await fetchUpdateCompany()
    emit('submitted')
}
const fetchUpdateCompany = async () => {
    loading.value = true
    try {
        await updateCompany(companyStore.id, formData)
    } catch (err) {
        console.log(err)
    } finally {
        loading.value = false
    }

    await companyStore.fetchCompany()
}
</script>

<template>
    {{ companyStore }}
    <q-form class="flex flex-col" @submit.prevent="submit">
        <h2 class="font-bold">Назва компанії</h2>
        <q-input
            v-model="formData.name"
            :disable="loading"
            :rules="[v => v.length >= 1 || `Назва компанії повинна мати хоча б 1 літеру`]"
            placeholder="Назва компанії"
            required
        />

        <q-btn
            :disabled="formData.name.length < 2 || loading"
            class="w-48"
            color="primary"
            type="submit"
        >
            Змінити назву
        </q-btn>
    </q-form>
</template>
