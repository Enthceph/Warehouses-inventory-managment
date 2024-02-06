<script lang="ts" setup>
import {updateCompany} from "@/api/company";
import {useCompanyStore} from "@/js/stores/company";

const emit = defineEmits(['submitted'])

const companyStore = useCompanyStore()
const name = ref(companyStore.name)
const loading = ref(false)


onMounted(async () => {
    loading.value = true

    let company = await companyStore.fetchCompany()
    name.value = company.name

    loading.value = false
})

const submit = async () => {
    loading.value = true
    try {
        await updateCompany(companyStore.id, {name: name.value})
        await companyStore.fetchCompany()
        emit('submitted')
    } catch (error) {
        console.error("Failed to update company", error)
    } finally {
        loading.value = false
    }
}

</script>

<template>
    <q-form class="flex flex-col" @submit.prevent="submit">
        <h2 class="font-bold">Назва компанії</h2>
        <div class="flex justify-between gap-5 items-center">
            <q-input
                v-model="name"
                :disable="loading"
                :rules="[
                v => v.length >= 1 || `Назва компанії повинна мати хоча б 1 літеру`,
                v => v !== companyStore.name || `Введите другое имя компании`
            ]"
                class="flex-1"
                placeholder="Назва компанії"
                required
            />
            <q-btn
                :disabled="name.length < 2 || loading"
                class="h-fit"
                color="primary"
                label="save"
                type="submit"

            />
        </div>
    </q-form>
</template>
