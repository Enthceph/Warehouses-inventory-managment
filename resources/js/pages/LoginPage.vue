<script setup lang="ts">
import { setToken } from "../utils/token";
import useApi from "../composables/useApi";
const router = useRouter()

//FORM
const form_data = reactive({
    email: 'test@test.com',
    password: 'qwertyui',
})

const {
    response,
    data,
    isError,
    error,
    errors,
    execute,
} = useApi('login', form_data, {
    immediate: false,
    onFetchResponse: () => {
        setToken(data.value!.access_token as string )

        router.push({
            path: '/outlets'
        })
    }
})


</script>

<template>
    <div class="form-wrapper">
        <q-form autocomplete="off" class="form" @submit.prevent="execute()">

            <h2>Форма авторизации</h2>

            <div class="form-inputs">
                <q-input v-model="form_data.email" autocomplete="off" label="Email" required="true" type="email" />
                <q-input v-model="form_data.password" autocomplete="off" label="Password" required="true" type="password" />
            </div>

            <div v-if="isError" class="error-box">
                {{ error }}
            </div>

            <div class="buttons-group">
                <q-btn type="submit" color="info">
                    Submit
                </q-btn>

                <q-btn type="reset" color="red">
                    Clear
                </q-btn>
            </div>

            <div class="to-registration-form">
                <router-link to="/registration">Еще не зарегестрированы?</router-link>
            </div>

        </q-form>
    </div>

</template>

<style scoped>
.form-wrapper {
    @apply flex-center w-full h-screen;
}

.form {
    @apply flex flex-col items-center justify-center w-full gap-6 p-8 max-w-lg px-12 py-9 rounded-lg;
    background-color: var(--va-background-secondary);

}

h2 {
    font-size: 26px;
    font-weight: bold;
}

.form-inputs {
    @apply flex flex-col gap-y-4;
    width: 100%;
}

.buttons-group {
    @apply flex justify-between w-full max-w-sm;
}

.to-registration-form {
    color: var(--va-primary);
    font-size: 12px;
}

.error-box {
    color: red;
    font-size: 14px;
}
</style>
