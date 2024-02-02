<script lang="ts" setup>
import {useFetching} from "@/js/composables/useFetching";
import {changeName} from "@/api/user";

const name = reactive({
    full_name: '',
})
// TODO отправлять данные в emit
const {fetch} = useFetching(changeName)

</script>

<template>
    <q-form class="flex flex-col">
        <h2 class="font-bold">Ім'я</h2>

        <q-input
            v-model="name.full_name"
            :rules="[v => v.length >= 2 || `Ім'я повинно мати хоча б 2 літери`]"
            placeholder="Имя"
        />
        <q-btn
            :disabled="name.full_name.length < 2"
            class="w-48"
            color="primary"
            @click="fetch(name)"
        >
            Змінити ім'я
        </q-btn>

    </q-form>
</template>
