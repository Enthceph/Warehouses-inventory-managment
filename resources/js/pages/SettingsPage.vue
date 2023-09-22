<script lang="ts" setup>

import { logout } from "@/api/auth";

import { deleteToken } from "@/js/utils/token";

import { useDialogPluginComponent } from 'quasar'


defineEmits([
    // REQUIRED; need to specify some events that your
    // component will emit through useDialogPluginComponent()
    ...useDialogPluginComponent.emits
])

// TODO поментять тут все на useApi
const { dialogRef, onDialogHide, onDialogOK, onDialogCancel } = useDialogPluginComponent()

const router = useRouter()
const exitModal = ref(false)
const newName = reactive({ name: 'test' })
const newPassword = reactive({
    new_password: 'asdfgh',
    old_password: 'qwertyui',
    password_conformation: 'qwertyui'
})


//Logout ---------------------------------------

const onExitOk = () => {
    logout().then((res) => {
        deleteToken()

        router.push({
            path: '/login'
        })
    }).catch((err) => {
        console.log(err)
    })
    router.push('/login')
}


//Change name    -------------------------------


//Change password -------------------------------
const fetchChangePassword = () => {

}

</script>


<template>
    <q-card>
        <q-card-section class="flex justify-space-between">
            <h2>Настройки</h2>
        </q-card-section>

        <q-separator inset />

        <q-card-section class="grid grid-cols-4 gap-4 items-center">
            <q-btn :disabled="newName.length < 2" color="primary" @click="">
                Сменить имя
            </q-btn>

            <q-input v-model="newName.name" :rules="[v => v.length >= 2 || `Имя должно иметь хотя бы 2 буквы`]"
                placeholder="Новое имя" />
        </q-card-section>

        <q-card-section class="grid grid-cols-4 gap-4 items-center">
            <q-btn :disabled="newPassword.old_password !== newPassword.password_conformation ||
                newPassword.new_password.length < 6
                " color="primary" @click="fetchChangePassword">
                Сменить пароль
            </q-btn>

            <q-input v-model="newPassword.new_password"
                :rules="[v => v.length >= 6 || `Длина пароля должна иметь хотя бы 6`]" placeholder="Новый пароль" />

            <q-input v-model="newPassword.old_password"
                :rules="[v => v.length >= 6 || `Длина пароля должна иметь хотя бы 6`]" placeholder="Старый пароль" />

            <q-input v-model="newPassword.password_conformation"
                :rules="[v => v === newPassword.old_password || `Пароли не равны`]" placeholder="Повторите старый пароль" />
        </q-card-section>

        <q-card-section class="grid grid-cols-4 gap-4 items-center ">
            <q-btn color="red" @click="exitModal = true">
                Выйти
            </q-btn>
        </q-card-section>
    </q-card>

    <!--    MODALS      -->


    <q-dialog ref="dialogRef" @hide="onDialogHide" v-model="exitModal">
        <q-card>
            <q-card-section>Вы действительно хотите выйти?</q-card-section>

            <q-card-actions align="right">
                <q-btn color="red" label="Выйти" @click="onExitOk" />
                <q-btn color="grey" label="Cancel" v-close-popup />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<style scoped></style>
