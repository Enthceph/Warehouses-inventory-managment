<script lang="ts" setup>
const formData = reactive({
    name: ''
})
const emit = defineEmits(['submit'])

const submit = () => {
    emit('submit', formData)
}

</script>

<template>
    <q-form class="flex flex-col" @submit.prevent="submit">
        <h2 class="font-bold">Название компании</h2>
        <!-- TODO получать и устанавливать здесь название компании-->
        <q-input
            v-model="formData.name"
            :rules="[v => v.length >= 1 || `Название компании должно иметь хотя бы 1 букву`]"
            placeholder="Название компании"
            required
        />

        <q-btn
            :disabled="formData.name.length < 2"
            class="w-48"
            color="primary"
            type="submit"
        >
            Сменить название
        </q-btn>

    </q-form>
</template>

<style scoped>

</style>
