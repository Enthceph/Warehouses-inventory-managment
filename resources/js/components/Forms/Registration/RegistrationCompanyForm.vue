<script lang="ts" setup>
import {Company} from "@/js/types/company.types";

export interface CompanyData {
    name: Company['name']
    address?: Company['address']
    contact_info?: Company['contact_info']
}

const form = ref()
const data = reactive<CompanyData>({
    name: 'test org name',
    address: '',
    contact_info: '',
})

const emit = defineEmits<{
    (e: 'submit', data: CompanyData): void;
    (e: 'stepBack'): void
}>();

const submit = () => {
    const validated = form.value.validate()
    if (!validated) return

    emit('submit', data)
}
</script>

<template>
    <q-form ref="form" autocomplete="off" class="form" tag="form" @submit.prevent="submit">
        <div class="form-inputs">
            <q-input
                v-model="data.name"
                hide-bottom-space
                label="Company name"
                required
            />

            <q-input
                v-model="data.address"
                hide-bottom-space
                label="Address"
            />

            <q-input
                v-model="data.contact_info"
                autocomplete="off"
                label="Contact Information"
            />
        </div>
        <div class="buttons">
            <q-btn
                color="primary"
                flat
                label="Back"
                @click="emit('stepBack')"
            />

            <q-btn
                color="primary"
                label="Register"
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
