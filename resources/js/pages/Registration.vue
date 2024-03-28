<script lang="ts" setup>
import RegistrationUserForm from '@/js/components/Forms/Registration/RegistrationUserForm.vue'
import RegistrationCompanyForm from '@/js/components/Forms/Registration/RegistrationCompanyForm.vue'
import { register } from '@/js/api/auth'
import { CompanyForm } from '../types/company.types'
import { UserForm } from '../types/user.types'

const router = useRouter()

const registrationData = reactive({
    user: <UserForm>{},
    company: <CompanyForm>{},
})

const step = ref(1)

const submitUserForm = (data: UserForm) => {
    step.value = 2
    registrationData.user = data
}

const submitOrganisationForm = async (data: CompanyForm) => {
    registrationData.company = data

    await register(registrationData)

    router.push('/login')
}
</script>

<template>
    <h2>Registration</h2>

    <q-stepper ref="stepper" v-model="step" animated color="primary" keep-alive>
        <q-step :done="step > 1" :name="1" icon="settings" title="User">
            <RegistrationUserForm @submit="submitUserForm" />
        </q-step>

        <q-step
            :done="step > 2"
            :name="2"
            icon="corporate_fare"
            title="Company"
        >
            <RegistrationCompanyForm
                :user="registrationData.user"
                @stepBack="step -= 1"
                @submit="submitOrganisationForm"
            />
        </q-step>
    </q-stepper>
</template>

<style scoped>
h2 {
    font-size: 26px;
    font-weight: bold;
}
</style>
