<script lang="ts" setup>
export interface UserData {
    first_name: string
    last_name: string
    email: string
    password: string
    password_confirmation: string
}

const form = ref()

const formData = reactive<UserData>({
    first_name: 'test',
    last_name: 'testovich',
    email: 'test@test.com',
    password: 'qwertyui',
    password_confirmation: 'qwertyui',
})

const emit = defineEmits<{
    (e: 'submit', data: UserData): void;
}>();

const submit = async () => {
    const validated = await form.value.validate()

    if (!validated) return;

    emit('submit', formData)
}
</script>

<template>
    <q-form ref="form" autocomplete="off" class="form" @submit.prevent="submit">
        <div class="form-inputs">
            <q-input
                v-model="formData.first_name"
                :rules="[v => v.length >= 2 || `Имя должно иметь хотя бы 2 буквы`]"
                hide-bottom-space
                label="First name"
                required
            />
            <q-input
                v-model="formData.last_name"
                :rules="[v => v.length >= 2 || `Фамилия должна иметь хотя бы 2 буквы`]"
                hide-bottom-space
                label="Last name"
                required
            />
            <q-input
                v-model="formData.email"
                autocomplete="off"
                label="Email"
                required
                type="email"
            />
            <q-input
                v-model="formData.password"
                autocomplete="off"
                label="Password"
                required
                type="password"
            />
            <q-input
                v-model="formData.password_confirmation"
                :rules="[v => v === formData.password || `Пароли не равны`]"
                hide-bottom-space
                label="Repeat password"
                required
                type="password"
            />
        </div>

        <div class="to-login-form">
            <router-link to="/login">Уже зарегистрированы?</router-link>
        </div>

        <div class="buttons">
            <q-btn color="primary" type="submit">Далее</q-btn>
        </div>
    </q-form>
</template>

<style scoped>
.form {
    @apply flex flex-col items-center justify-center w-full gap-6  max-w-lg  rounded-lg;
    background-color: var(--va-background-secondary);
}

h2 {
    font-size:   26px;
    font-weight: bold;
}

.form-inputs {
    @apply flex flex-col gap-y-4 w-full;
}

.buttons {
    display:         flex;
    justify-content: end;
    width:           100%;
}

.to-login-form {
    color:     var(--va-primary);
    font-size: 12px;
}
</style>
