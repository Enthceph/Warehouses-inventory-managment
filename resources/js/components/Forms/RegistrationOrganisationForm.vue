<script lang="ts" setup>
const form = ref()

export interface OrganisationData {
    name: string
    address?: string
    contact_info?: string

}

const data = reactive<OrganisationData>({
    name: 'test org name',
    address: '',
    contact_info: '',
})

const emit = defineEmits<{
    (e: 'submit', data: OrganisationData): void;
    (e: 'stepBack'): void
}>();

const submit = async () => {
    const validated = await form.value.validate()
    console.log(validated)
    emit('submit', data)
}
</script>

<template>
    <q-form ref="form" autocomplete="off" class="form" tag="form" @submit.prevent="submit">
        <div class="form-inputs">
            <q-input
                v-model="data.name"
                hide-bottom-space
                label="Title"
                required
            />

            <q-input
                v-model="data.address"
                hide-bottom-space
                label="address"
            />

            <q-input
                v-model="data.contact_info"
                autocomplete="off"
                label="Contact info"
            />
        </div>
        <div class="buttons">
            <q-btn
                class="q-ml-sm"
                color="primary"
                flat
                label="Назад"
                @click="emit('stepBack')"
            />

            <q-btn
                color="primary"
                label="Регистрация"
                type="submit"
            />
        </div>
    </q-form>
</template>

<style scoped>
.form {
    @apply flex flex-col items-center justify-center w-full gap-6  max-w-lg  rounded-lg;
    background-color: var(--va-background-secondary);
}

h2 {
    font-size:   26px;
    font-weight: bold;
}

.buttons {
    display:         flex;
    justify-content: space-between;
    width:           100%;
}

.form-inputs {
    @apply flex flex-col gap-y-4;
    width: 100%;
}
</style>
