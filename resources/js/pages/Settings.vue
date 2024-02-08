<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import LogoutForm from "@/js/components/Forms/Login/LogoutForm.vue";
import {useAuthStore} from "@/js/stores/auth";
import ChangePasswordForm from "@/js/components/Forms/Auth/ChangePasswordForm.vue";
import ChangeNameForm from "@/js/components/Forms/Auth/ChangeNameForm.vue";
import ChangeCompanyNameForm from "@/js/components/Forms/Company/ChangeCompanyNameForm.vue";
import ChangeEmailForm from "@/js/components/Forms/Auth/ChangeEmailForm.vue";

defineEmits([...useDialogPluginComponent.emits])
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const authStore = useAuthStore()

const tab = ref('company')
const splitterModel = ref(120)
const logoutModal = ref(false)

onMounted(async () => {
    await authStore.getUser()

    tab.value = authStore.role === 'Owner' ? 'company' : 'profile'
})
</script>
<template>
    <q-card>
        <q-card-section>
            <q-splitter v-model="splitterModel" unit="px">
                <template v-slot:before>
                    <q-tabs
                        v-model="tab"
                        vertical
                    >
                        <q-tab v-if="authStore.role === 'Owner'" icon="apartment" label="Company" name="company"/>
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
                        transition-prev="jump-down"
                        vertical
                    >
                        <q-tab-panel v-if="authStore.role === 'Owner'" class="pr-0" name="company">
                            <ChangeCompanyNameForm/>
                        </q-tab-panel>

                        <q-tab-panel class="pr-0" name="profile">
                            <ChangeNameForm/>
                            <ChangeEmailForm/>
                            <div>
                                <h2 class="text-bold">Role</h2>
                                <q-input
                                    v-model="authStore.role"
                                    disable
                                />
                            </div>
                        </q-tab-panel>

                        <q-tab-panel class="pr-0" name="password">
                            <ChangePasswordForm/>
                        </q-tab-panel>
                    </q-tab-panels>
                </template>
            </q-splitter>
        </q-card-section>
        <q-card-section class="grid grid-cols-4 gap-4 justify-items-end">
            <q-btn class="w-24 col-start-4" color="red" label="exit" @click="logoutModal = true"/>
        </q-card-section>
    </q-card>

    <!--    MODALS      -->

    <q-dialog ref="dialogRef" v-model="logoutModal" @hide="onDialogHide">
        <LogoutForm
            @cancel="logoutModal=false"
            @submit="logoutModal=false"
        />
    </q-dialog>
</template>
