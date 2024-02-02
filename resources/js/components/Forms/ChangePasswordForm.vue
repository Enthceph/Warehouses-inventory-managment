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
    <q-form class="flex flex-col" @submit="fetchPassword(passwordForm)">
        <h2 class="font-bold">Пароль</h2>
        <q-input
            v-model="passwordForm.new_password"
            :rules="[v => v.length >= 6 || `Довжина пароля повинна мати хоча б 6 букв`]"
            placeholder="Новий пароль"
            required
        />

        <q-input
            v-model="passwordForm.old_password"
            :rules="[v => v.length >= 6 || `Довжина пароля повинна мати хоча б 6 букв`]"
            placeholder="Старий пароль"
            required
        />

        <q-input
            v-model="passwordForm.password_conformation"
            :rules="[v => v === passwordForm.old_password || `Паролі не рівні`]"
            placeholder="Повторіть старий пароль"
            required
        />
        <q-btn
            :disabled="!formIsValid"
            class="w-48"
            color="primary"
            type="submit"
        >
            Змінити пароль
        </q-btn>
    </q-form>
</template>
