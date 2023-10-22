<script lang="ts" setup>
import {useFetching} from "@/js/composables/useFetching";
import {changePassword} from "@/api/user";

const passwordForm = reactive({
    new_password: 'asdfgh',
    old_password: 'qwertyui',
    password_conformation: 'qwertyui'
})
// TODO отправлять данные в emit
const {fetch: fetchPassword} = useFetching(changePassword)

const formIsValid = computed(() => {
    if (passwordForm.old_password !== passwordForm.password_conformation)
        return false
    else if (passwordForm.new_password.length < 6)
        return false

    return true
})

</script>

<template>
    <q-form class="grid grid-cols-4 gap-4 items-center" @submit="fetchPassword(passwordForm)">
        <q-btn
            :disabled="!formIsValid"
            color="primary"
            type="submit"
        >
            Сменить пароль
        </q-btn>

        <q-input
            v-model="passwordForm.new_password"
            :rules="[v => v.length >= 6 || `Длина пароля должна иметь хотя бы 6`]"
            placeholder="Новый пароль"
            required
        />

        <q-input
            v-model="passwordForm.old_password"
            :rules="[v => v.length >= 6 || `Длина пароля должна иметь хотя бы 6`]"
            placeholder="Старый пароль"
            required
        />

        <q-input
            v-model="passwordForm.password_conformation"
            :rules="[v => v === passwordForm.old_password || `Пароли не равны`]"
            placeholder="Повторите старый пароль"
            required
        />
    </q-form>
</template>
