<script lang="ts" setup>
import {useFetching} from "@/js/composables/useFetching";
import {changeName} from "@/api/user";
import {useUserStore} from "@/js/stores/user";

const userStore = useUserStore()

const name = reactive({
    first_name: '',
    last_name: ''
})
// TODO отправлять данные в emit
const {fetch} = useFetching(changeName)

onMounted(async () => {
    await userStore.fetchUser()
    name.first_name = userStore.first_name
    name.last_name = userStore.last_name
})
</script>

<template>
    <q-form class="grid grid-cols-4 gap-4 items-center">
        <q-btn
            :disabled="name.first_name.length < 2 || name.last_name.length < 2"
            color="primary"
            @click="fetch(name)"
        >
            Сменить имя
        </q-btn>

        <q-input
            v-model="name.first_name"
            :rules="[v => v.length >= 2 || `Имя должно иметь хотя бы 2 буквы`]"
            placeholder="Имя"
        />

        <q-input
            v-model="name.last_name"
            :rules="[v => v.length >= 2 || `Фамилия должна иметь хотя бы 2 буквы`]"
            placeholder="Фамилия"
        />
    </q-form>
</template>
