<script lang="ts" setup>
const props = defineProps({
    error: String,
})

const emit = defineEmits<{
    (e: 'submit', data: { email: string; password: string }): void;
}>();

const form = ref(null)

const formData = reactive({
    email: 'test@test.com',
    password: 'qwertyui'
})

const onSubmit = () => {
    emit('submit', formData);
};
</script>

<template>
    <q-card>
        <q-form ref="form" autocomplete="off" class="form" @submit.prevent="onSubmit">

            <h2 class="text-h5 font-bold">Авторизація</h2>

            <div class="form-inputs">
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
                    label="Пароль"
                    required
                    type="password"
                />
            </div>

            <div v-if="props.error" class="error-box">
                {{ props.error }}
            </div>

            <div class="buttons-group">
                <q-btn class="w-full" color="info" type="submit">
                    Увійти
                </q-btn>
            </div>

            <div class="to-registration-form">
                <router-link to="/registration">Ще не зареєстровані?</router-link>
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
    color:     var(--va-primary);
    font-size: 12px;
}

.error-box {
    color:     red;
    font-size: 14px;
}
</style>
