<script lang="ts" setup>
import {deleteToken} from "@/js/utils/token";
import router from "@/js/router";
import {logout} from "@/api/auth";
import {useAuthStore} from "@/js/stores/auth";

const emit = defineEmits(['submit', 'cancel'])

const authStore = useAuthStore()

const loading = ref(false)

const submit = async () => {
    loading.value = true

    try {
        await logout()

        deleteToken()

        authStore.clearUser()

        emit('submit')

        router.push({
            path: '/login'
        })
    } catch (error) {
        console.error("Failed to logout", error)
    } finally {
        loading.value = false
    }
}
</script>

<template>
    <q-card class="p-4 relative-position ">
        <q-form @submit.prevent="submit">
            <q-card-section class="text-h5 text-center text-bold">
                EXIT?
            </q-card-section>

            <q-separator/>

            <q-card-section>
                Do you really want to leave?
            </q-card-section>

            <q-separator/>
            <q-card-actions align="between">
                <q-btn
                    :disable="loading"
                    color="grey"
                    label="Cancel"
                    @click="emit('cancel')"
                />

                <q-btn
                    :disable="loading"
                    class="text-bold"
                    color="red"
                    flat
                    label="Exit"
                    type="submit"
                />
            </q-card-actions>
        </q-form>

        <q-inner-loading :showing="loading">
            <q-spinner-gears color="primary" size="50px"/>
        </q-inner-loading>
    </q-card>
</template>
