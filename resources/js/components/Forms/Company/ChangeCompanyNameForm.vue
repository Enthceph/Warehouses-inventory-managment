<script lang="ts" setup>
import {updateCompany} from "@/api/company";
import {useCompanyStore} from "@/js/stores/company";
import {Notify, QForm} from 'quasar'

const emit = defineEmits(['submit'])

const form = ref<QForm>() as Ref<QForm>
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

        emit('submit')

        Notify.create({
            type: 'success',
            message: 'Company updated'
        })
    } catch (error) {
        console.error("Failed to update company name", error)
    } finally {
        loading.value = false
    }
}
</script>
<template>
    <q-form ref="form" class="form form--compact" @submit.prevent="submit">
        <h2 class="form__heading">Company name</h2>
        <div class="form__content form__content--compact">
            <q-input
                v-model="name"
                :disable="loading"
                :rules="[
                    v => v.length >= 1 || `The company name must have at least 1 letter`,
                    v => v !== companyStore.name || `Enter a different company name if you want to change it`
                ]"
                class="form__input form__input--compact"
                placeholder="Company name"
                required
            />
            <q-btn
                :disabled="name.length < 2 || loading"
                class="form__button form__button--compact"
                color="primary"
                label="save"
                type="submit"
            />
        </div>
    </q-form>
</template>
<style scoped src="@/css/form.css"/>
