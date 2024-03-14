<script lang="ts" setup>
import {changePassword} from "@/api/auth";

import {Notify, QForm} from 'quasar'

const emit = defineEmits(['submit'])

const form = ref<QForm>() as Ref<QForm>
const formData = reactive({
    new_password: 'asdfgh',
    password_confirmation: 'asdfgh',
    old_password: 'qwertyui'
})
const loading = ref(false)

const submit = async () => {
    loading.value = true

    try {
        await changePassword(formData)

        emit('submit')

        Notify.create({
            type: 'success',
            message: 'Password updated'
        })
    } catch (error) {
        console.error("Failed to update password", error)
    } finally {
        loading.value = false
    }
}
</script>
<template>
    <q-form class="form" @submit="submit">
        <h2 class="form__heading">Password</h2>
        <q-input v-model="formData.new_password"
            :rules="[v => v.length >= 6 || `The length of the password must be at least 6 letters`]"
            placeholder="New password" required />
        <q-input v-model="formData.password_confirmation"
            :rules="[v => v === formData.new_password || `The passwords are not the same`]"
            placeholder="Repeat new password" required />

        <q-input v-model="formData.old_password"
            :rules="[v => v.length >= 6 || `The length of the password must be at least 6 letters`]"
            placeholder="Old password" required />
        <q-btn class="form__button" color="primary" label="save" type="submit" />
    </q-form>
</template>
<style scoped src="@/css/form.css" />
@/js/api/auth