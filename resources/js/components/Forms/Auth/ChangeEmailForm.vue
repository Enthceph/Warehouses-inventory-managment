<script lang="ts" setup>
import { Notify, QForm } from 'quasar'
import { changeEmail } from "@/js/api/auth";
import { useAuthStore } from "@/js/stores/auth";

const emit = defineEmits(['submit'])

const authStore = useAuthStore()

const form = ref<QForm>() as Ref<QForm>
const email = ref('')
const loading = ref(false)

onMounted(() => {
    email.value = authStore.email
})

const submit = async () => {
    loading.value = true

    try {
        await changeEmail({ email: email.value })

        await authStore.getUser()

        emit('submit')

        Notify.create({
            type: 'success',
            message: 'Email updated'
        })
    } catch (error) {
        console.error("Failed to update email", error)
    } finally {
        loading.value = false
    }
}
</script>
<template>
    <q-form ref="form" class="form form--compact" @submit.prevent="submit">
        <h2 class="form__heading">Email</h2>
        <div class="form__content form__content--compact">
            <q-input v-model="email" :disable="loading" class="form__input form__input--compact" placeholder="Email"
                required type="email" />

            <q-btn :disabled="!email || loading" class="form__button form__button--compact" color="primary" label="save"
                type="submit" />
        </div>
    </q-form>
</template>
<style scoped src="@/css/form.css" />
@/js/api/auth