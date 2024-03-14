<script lang="ts" setup>
import {Notify, QForm} from 'quasar'
import {changeName} from "@/api/auth";
import {useAuthStore} from "@/js/stores/auth";

const emit = defineEmits(['submit'])

const authStore = useAuthStore()

const form = ref<QForm>() as Ref<QForm>
const name = ref('')
const loading = ref(false)

onMounted(() => {
    name.value = authStore.full_name
})

const submit = async () => {
    loading.value = true
    try {
        await changeName({name: name.value})

        await authStore.getUser()

        emit('submit')

        Notify.create({
            type: 'success',
            message: 'Name updated'
        })
    } catch (error) {
        console.error("Failed to update name", error)
    } finally {
        loading.value = false
    }
}
</script>
<template>
    <q-form ref="form" class="form form--compact" @submit.prevent="submit">
        <h2 class="form__heading">Name</h2>
        <div class="form__content form__content--compact">
            <q-input v-model="name" :disable="loading"
                :rules="[v => v.length >= 2 || `The name must have at least 2 letters`]"
                class="form__input form__input--compact" placeholder="Name" required />

            <q-btn :disabled="name.length < 2 || loading" class="form__button form__button--compact" color="primary"
                label="save" type="submit" />
        </div>
    </q-form>
</template>
<style scoped src="@/css/form.css" />
@/js/api/auth