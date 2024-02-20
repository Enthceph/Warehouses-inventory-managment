<script lang="ts" setup>
import LoginForm from "@/js/components/Forms/Login/LoginForm.vue";

const router = useRouter()

const onFormSubmit = () => {
    router.push({
        path: '/analytics'
    })
}

</script>

<template>
    12323s
    <LoginForm @submit="onFormSubmit" />
</template>
