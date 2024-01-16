<script lang="ts" setup>
import {logout} from "@/api/auth";

import {deleteToken} from "@/js/utils/token";

import {useDialogPluginComponent} from 'quasar'
import ChangeNameForm from "@/js/components/Forms/ChangeNameForm.vue";
import ChangePasswordForm from "@/js/components/Forms/ChangePasswordForm.vue";
import {useFetching} from "@/js/composables/useFetching";
import LogoutForm from "@/js/components/Forms/Login/LogoutForm.vue";
import ChangeCompanyNameForm from "@/js/components/Forms/Company/ChangeCompanyNameForm.vue";

defineEmits([...useDialogPluginComponent.emits])
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const router = useRouter()

const logoutModal = ref(false)

const {fetch: fetchLogout} = useFetching(logout)

const onLogoutModalOk = () => {
    fetchLogout().then((res) => {
        deleteToken()

        router.push({
            path: '/login'
        })
    }).catch((err) => {
        console.log(err)
    })

    router.push('/login')
}
// TODO сделать смену имени компании и смену email
</script>
<template>
    <q-card>
        <q-card-section class="flex justify-space-between">
            <h1 class="text-h6">Настройки</h1>
        </q-card-section>

        <q-separator inset/>

        <q-card-section class="max-w-sm">
            <ChangeCompanyNameForm/>
        </q-card-section>

        <q-separator inset/>

        <q-card-section class="max-w-sm">
            <ChangeNameForm/>
        </q-card-section>

        <q-separator inset/>

        <q-card-section class="max-w-sm">
            <ChangePasswordForm/>
        </q-card-section>

        <q-card-section class="grid grid-cols-4 gap-4 items-center">
            <div></div>
            <div></div>
            <div></div>
            <q-btn color="red" @click="logoutModal = true">
                Выйти
            </q-btn>
        </q-card-section>
    </q-card>

    <!--    MODALS      -->

    <q-dialog ref="dialogRef" v-model="logoutModal" @hide="onDialogHide">
        <LogoutForm
            @cancel="logoutModal=false"
            @submit="onLogoutModalOk"
        />
    </q-dialog>
</template>
