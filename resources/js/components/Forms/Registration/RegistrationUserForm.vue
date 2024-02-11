<script lang="ts" setup>
export interface UserData {
    full_name: string
    email: string
    password: string
    password_confirmation: string
}

const form = ref()

const formData = reactive<UserData>({
    full_name: 'test testovich',
    email: 'test@test.com',
    password: 'qwertyui',
    password_confirmation: 'qwertyui',
})

const emit = defineEmits<{
    (e: 'submit', data: UserData): void;
}>();

const submit = () => {
    const validated = form.value.validate()

    if (!validated) return;

    emit('submit', formData)
}
</script>

<template>
    <q-form ref="form" autocomplete="off" class="form" @submit.prevent="submit">
        <div class="form-inputs">
            <q-input
                v-model="formData.full_name"
                :rules="[v => v.length >= 2 || `The name must have at least 2 letters`]"
                hide-bottom-space
                label="Name"
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
                :rules="[v => v === formData.password || `The passwords are not the same`]"
                hide-bottom-space
                label="Repeat the password"
                required
                type="password"
            />
        </div>

        <div class="to-login-form">
            <router-link to="/login">Already registered?</router-link>
        </div>

        <div class="buttons">
            <q-btn color="primary" type="submit">Next</q-btn>
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
