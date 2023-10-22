<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import {logout} from "@/api/auth"
import {deleteToken} from "@/js/utils/token"
import router from "@/js/router"

defineEmits([
    ...useDialogPluginComponent.emits
])


const {dialogRef, onDialogHide, onDialogOK, onDialogCancel} = useDialogPluginComponent()
const props = defineProps({
    show: Boolean
})

const onLogoutSubmit = () => {
    // TODO заменить на useFetching
    logout().then(() => {
        deleteToken()

        router.push({
            path: '/login'
        })
    }).catch((err) => {
        console.log(err)
    })

    router.push('/login')
}

const show = computed(() => props.show);

</script>

<template>
    <q-dialog ref="dialogRef" v-model="show" @hide="onDialogHide">
        <q-card>
            <q-card-section>Вы действительно хотите выйти?</q-card-section>

            <q-card-actions align="right">
                <q-btn color="red" label="Выйти" @click="onLogoutSubmit"/>
                <q-btn v-close-popup color="grey" label="Cancel"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>
