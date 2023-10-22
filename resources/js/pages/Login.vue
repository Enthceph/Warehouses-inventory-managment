<script lang="ts" setup>
import {useFetching} from "@/js/composables/useFetching";
import {login} from "@/api/auth";
import LoginForm from "@/js/components/Forms/LoginForm.vue";
import {setToken} from "@/js/utils/token";

const router = useRouter()

const {fetch: fetchLogin} = useFetching(login)

const onFormSubmit = async (formData: { email: string, password: string }) => {
    const res = await fetchLogin(formData)

    setToken(res.access_token as string)

    router.push({
        path: '/organisation'
    })
}

</script>

<template>
    <LoginForm
        @submit="onFormSubmit"
    />
</template>
