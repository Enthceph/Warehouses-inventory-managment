<script lang="ts" setup>

import {logout} from "@/api/auth";

import {deleteToken} from "@/js/utils/token";

import {useDialogPluginComponent} from 'quasar'
import ChangeNameForm from "@/js/components/Forms/ChangeNameForm.vue";
import ChangePasswordForm from "@/js/components/Forms/ChangePasswordForm.vue";

defineEmits([
    ...useDialogPluginComponent.emits
])

const {dialogRef, onDialogHide, onDialogOK, onDialogCancel} = useDialogPluginComponent()

const router = useRouter()
const exitModal = ref(false)


//Logout ---------------------------------------

const onLogoutModalOk = () => {
    // TODO заменить на useFetching
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
</script>


<template>
    <q-card>
        <q-card-section class="flex justify-space-between">
            <h1 class="text-h6">Настройки</h1>
        </q-card-section>

        <q-separator inset/>

        <q-card-section>
            <ChangeNameForm/>
        </q-card-section>

        <q-card-section>
            <ChangePasswordForm/>
        </q-card-section>

        <q-card-section class="grid grid-cols-4 gap-4 items-center">
            <q-btn color="red" @click="exitModal = true">
                Выйти
            </q-btn>
        </q-card-section>
    </q-card>

    <!--    MODALS      -->

    <q-dialog ref="dialogRef" v-model="exitModal" @hide="onDialogHide">
        <q-card>
            <q-card-section>Вы действительно хотите выйти?</q-card-section>

            <q-card-actions align="right">
                <q-btn color="red" label="Выйти" @click="onLogoutModalOk"/>
                <q-btn v-close-popup color="grey" label="Cancel"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>
