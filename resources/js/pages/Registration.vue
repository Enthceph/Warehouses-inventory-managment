<script lang="ts" setup>

import useApi from "@/js/composables/useApi";

const router = useRouter();

const user_form = ref(null)
const user_data = reactive({
    first_name: 'test',
    last_name: 'testovich',
    email: 'test@test.com',
    password: 'qwertyui',
    password_confirmation: 'qwertyui',
})
const organisation_form = ref(null)
const organisation_data = reactive({
    name: 'test org name',
    address: '',
    contact_info: '',
})

const registration = useApi('register', {
    immediate: false
}).post({
    user_data,
    organisation_data
}).json()
const fetchRegistration = async () => {
    if (!await user_form.value.validate()) {
        step.value = 1
        return;
    }
    if (!await organisation_form.value.validate()) {
        step.value = 2
    }

    await registration.execute()
}

const step = ref(1)

</script>

<template>
    <div class="form-wrapper">
        <h2>Форма регистрации</h2>
        <q-stepper
            ref="stepper"
            v-model="step"
            animated
            color="primary"
            keep-alive
        >
            <q-step
                :done="step > 1"
                :name="1"
                icon="settings"
                title="Пользователь"
            >
                <q-form ref="user_form" autocomplete="off" class="form" @submit.prevent="">
                    <div class="form-inputs">
                        <q-input v-model="user_data.first_name"
                                 :rules="[v => v.length >= 2 || `Имя должно иметь хотя бы 2 буквы`]"
                                 hide-bottom-space
                                 label="First name"
                                 required
                        />
                        <q-input v-model="user_data.last_name"
                                 :rules="[v => v.length >= 2 || `Фамилия должно иметь хотя бы 2 буквы`]"
                                 hide-bottom-space
                                 label="Last name"
                                 required
                        />

                        <q-input v-model="user_data.email" autocomplete="off" label="Email" required type="email"/>
                        <q-input v-model="user_data.password" autocomplete="off" label="Password" required
                                 type="password"/>

                        <q-input v-model="user_data.password_confirmation"
                                 :rules="[v => v === user_data.password || `Пароли не равны`]"
                                 hide-bottom-space
                                 label="Repeat password"
                                 required
                                 type="password"/>
                    </div>


                    <div class="to-login-form">
                        <router-link to="/login">Уже зарегистрированы?</router-link>
                    </div>

                </q-form>
            </q-step>

            <q-step
                :done="step > 2"
                :name="2"
                icon="settings"
                title="Организация"
            >
                <q-form ref="organisation_form" autocomplete="off" class="form" tag="form" @submit.prevent="">
                    <div class="form-inputs">
                        <q-input v-model="organisation_data.name"
                                 hide-bottom-space
                                 label="Title"
                                 required
                        />
                        <q-input v-model="organisation_data.address"
                                 hide-bottom-space
                                 label="address"
                        />

                        <q-input
                            v-model="organisation_data.contact_info"
                            autocomplete="off"
                            label="Contact info"
                        />
                    </div>


                </q-form>
            </q-step>

            <template v-slot:navigation>
                <q-stepper-navigation class="flex justify-between">
                    <div>
                        <q-btn v-if="step === 1" color="primary" label="Continue" @click="$refs.stepper.next()"/>
                        <q-btn v-if="step > 1" class="q-ml-sm" color="primary" flat label="Back"
                               @click="$refs.stepper.previous()"/>
                    </div>
                    <q-btn v-if="step === 2" color="primary" label="Submit" @click="fetchRegistration"/>
                </q-stepper-navigation>
            </template>


        </q-stepper>
        <div v-if="registration.error" class="error-box">
            {{ registration.error }}
        </div>

    </div>
    <div class="dev">{{ registration }}</div>
</template>

<style scoped>
.form-wrapper {
    @apply flex-center w-full h-screen flex-col;
}

.form {
    @apply flex flex-col items-center justify-center w-full gap-6  max-w-lg  rounded-lg;
    background-color: var(--va-background-secondary);
}

h2 {
    font-size:   26px;
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
    color:     var(--va-primary);
    font-size: 12px;
}
</style>
