<script lang="ts" setup>
import { setToken } from "@/js/utils/token";
import { login } from "@/js/api/auth";

const emit = defineEmits<{ (e: 'submit'): void; }>();

const form = ref(null)
const data = reactive({
    email: 'test@test.com',
    password: 'qwertyui'
})
const loading = ref(false)

const submit = async () => {
    loading.value = true

    try {
        const res = await login(data)
        setToken(res.access_token);

        emit('submit')
    } catch (error) {
        console.error("Failed to update company", error)
    } finally {
        loading.value = false
    }
}
</script>

<template>
    <q-card>
        <q-form ref="form" autocomplete="off" class="form" @submit.prevent="submit">
            <h2 class="text-h5 font-bold">Login</h2>

            <div class="form-inputs">
                <q-input v-model="data.email" autocomplete="off" label="Email" required type="email" />
                <q-input v-model="data.password" autocomplete="off" label="Password" required type="password" />
            </div>

            <div class="buttons-group">
                <q-btn class="w-full" color="info" type="submit">
                    Login
                </q-btn>
            </div>

            <div class="to-registration-form">
                <router-link to="/registration">Not registered yet?</router-link>
            </div>
        </q-form>
    </q-card>
</template>

<style scoped>
.form {
    @apply flex flex-col items-center justify-center gap-6 p-8 px-12 py-9 rounded-lg;
    background-color: var(--va-background-secondary);
}

.form-inputs {
    @apply flex flex-col gap-y-4 w-full;
}

.buttons-group {
    @apply flex justify-center w-full max-w-sm;
}

.to-registration-form {
    color: var(--va-primary);
    font-size: 12px;
}
</style>
@/js/api/auth