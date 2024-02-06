<script lang="ts" setup>
import {logout} from "@/api/auth";

import {deleteToken} from "@/js/utils/token";

import {useDialogPluginComponent} from 'quasar'
import {useFetching} from "@/js/composables/useFetching";
import LogoutForm from "@/js/components/Forms/Login/LogoutForm.vue";
import {useAuthStore} from "@/js/stores/auth";
import ChangePasswordForm from "@/js/components/Forms/Auth/ChangePasswordForm.vue";
import ChangeNameForm from "@/js/components/Forms/Auth/ChangeNameForm.vue";
import ChangeCompanyNameForm from "@/js/components/Forms/Company/ChangeCompanyNameForm.vue";

defineEmits([...useDialogPluginComponent.emits])
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const router = useRouter()
const authStore = useAuthStore()

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
onMounted(() => {
    authStore.getUser()
})
const tab = ref('company')
const innerTab = ref('company')
const splitterModel = ref(120)
// TODO сделать смену email
</script>
<template>

    <!-- <q-card>
        <q-card-section class="flex justify-space-between">
            <h1 class="text-h6">Налаштування</h1>
        </q-card-section>

        <q-separator inset/>

        <q-card-section v-if="authStore.role === 'Owner'" class="max-w-sm">
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
    </q-card> -->


    <q-card>
        <q-card-section>
            <q-splitter v-model="splitterModel" unit="px">
                <template v-slot:before>
                    <q-tabs
                        v-model="tab"
                        vertical
                    >
                        <q-tab icon="apartment" label="Company" name="company"/>
                        <q-tab icon="account_circle" label="Profile" name="profile"/>
                        <q-tab icon="lock" label="Password" name="password"/>
                    </q-tabs>
                </template>

                <template v-slot:after>
                    <q-tab-panels
                        v-model="tab"
                        animated
                        swipeable
                        transition-next="jump-up"
                        transition-prev="jump-up"
                        vertical
                    >
                        <q-tab-panel name="company">
                            <ChangeCompanyNameForm/>
                        </q-tab-panel>

                        <q-tab-panel name="profile">
                            <ChangeNameForm/>
                        </q-tab-panel>

                        <q-tab-panel name="password">
                            <ChangePasswordForm/>
                        </q-tab-panel>
                    </q-tab-panels>
                </template>

            </q-splitter>
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
