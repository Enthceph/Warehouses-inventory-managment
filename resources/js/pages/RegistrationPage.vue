<script setup>
import useApi from '../composables/useApi';

const router = useRouter();

const form_data = reactive({
    first_name: 'test',
    last_name: 'testovich',
    email: 'test@test.com',
    password: 'qwertyui',
    password_confirmation: 'qwertyui',
})

const reset = () => {
    form_data.first_name = ''
    form_data.last_name = ''
    form_data.email = ''
    form_data.password = ''
    form_data.password_confirmation = ''
}

const {
    isError,
    error,
    execute,
} = useApi('register',form_data, {
    immediate: false,
    onFetchResponse: () => {
        router.push({ path: '/login' })
    }
})
</script>

<template>
    <div class="form-wrapper">
        <q-form autocomplete="off" class="form" tag="form" @submit.prevent="execute()">

            <h2>Форма регистрации</h2>

            <div class="form-inputs">
                <q-input v-model="form_data.first_name"
                         :rules="[v => v.length >= 2 || `Имя должно иметь хотя бы 2 буквы`]"
                         label="First name" required type="text" />
                <q-input v-model="form_data.last_name"
                         :rules="[v => v.length >= 2 || `Фамилия должно иметь хотя бы 2 буквы`]"
                         label="Last name" required type="text" />

                <q-input v-model="form_data.email" autocomplete="off" label="Email" required type="email" />
                <q-input v-model="form_data.password" autocomplete="off" label="Password" required type="password" />

                <q-input v-model="form_data.password_confirmation"
                    :rules="[v => v === form_data.password || `Пароли не равны`]" label="Repeat password" required
                    type="password" />
            </div>

            <div v-if="isError" class="error-box">
                {{ error }}
            </div>

            <div class="buttons-group">
                <q-btn type="submit" color="info">Submit</q-btn>

                <q-btn color="red" type="reset" @click="reset">Reset</q-btn>
            </div>

            <div class="to-login-form">
                <router-link to="/login">Уже зарегистрированы?</router-link>
            </div>

        </q-form>



    </div>

<!--    <table>-->
<!--        <tr>-->
<!--            <td>isFinished:</td>-->
<!--            <td>{{isFinished}}</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>isFetching:</td>-->
<!--            <td>{{isFetching}}</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>statusCode:</td>-->
<!--            <td>{{statusCode}}</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>response:</td>-->
<!--            <td>{{JSON.stringify(response.value)}}</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>data:</td>-->
<!--            <td>{{data}}</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>isError:</td>-->
<!--            <td>{{isError}}</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>error:</td>-->
<!--            <td>{{error}}</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>errors:</td>-->
<!--            <td>{{errors}}</td>-->
<!--        </tr>-->
<!--    </table>-->
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

.to-login-form {
    color: var(--va-primary);
    font-size: 12px;
}
</style>
