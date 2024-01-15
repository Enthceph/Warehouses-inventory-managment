<script lang="ts" setup>

import RegistrationUserForm, {UserData} from "@/js/components/Forms/Registration/RegistrationUserForm.vue";
import RegistrationCompanyForm, {
    CompanyData
} from "@/js/components/Forms/Registration/RegistrationOrganisationForm.vue";
import {useFetching} from "@/js/composables/useFetching";
import {register} from "@/api/auth";

const router = useRouter();

const registrationData = reactive({
    user_data: {},
    company_data: {}
})

const step = ref(1)

const {fetch: fetchRegistration, error, errors} = useFetching(register)

const submitUserForm = (data: UserData) => {
    step.value = 2
    registrationData.user_data = data

}
const submitOrganisationForm = async (data: CompanyData) => {
    registrationData.company_data = data

    await fetchRegistration(registrationData)

    router.push('/login')
}
</script>

<template>
    <h2>Регистрация</h2>

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
            <RegistrationUserForm
                @submit="submitUserForm"
            />
        </q-step>

        <q-step
            :done="step > 2"
            :name="2"
            icon="corporate_fare"
            title="Компания"
        >
            <RegistrationCompanyForm
                :user="registrationData.user_data"
                @stepBack="step -= 1"
                @submit="submitOrganisationForm"
            />
        </q-step>
    </q-stepper>

    <div v-if="error" class="error-box">
        {{ error }}
    </div>
</template>

<style scoped>
h2 {
    font-size: 26px;
    font-weight: bold;
}
</style>
