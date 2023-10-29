<script lang="ts" setup>
export interface Outlet {
    name: string
    address?: string
    contact_info?: string
}

const emit = defineEmits(['submit', 'cancel'])

const form = ref()
const data = reactive<Outlet>({
    name: '',
    address: '',
    contact_info: '',
})

const submit = () => {
    const validated = form.value.validate()

    if (!validated) return

    emit('submit', data)
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <q-card class="q-dialog-plugin">
        <q-form ref="form" @submit.prevent="submit">
            <q-card-section>
                <h2 class="text-h5 text-center">Добавить точку</h2>
            </q-card-section>

            <q-card-section>
                <q-form ref="add_outlet_form" autocomplete="off" @submit.prevent="">
                    <q-input
                        v-model="data.name"
                        :rules="[v => v.length >= 2 || `Название точки должно иметь хотя бы 2 буквы`]"
                        hide-bottom-space
                        label="Outlet Name"
                        placeholder="Enter outlet name"
                        required
                    />

                    <q-input
                        v-model="data.address"
                        label="Outlet Address"
                        placeholder="Enter outlet address"
                    />

                    <q-input
                        v-model="data.contact_info"
                        label="Contact Information"
                        placeholder="Enter contact information"
                    />
                </q-form>
            </q-card-section>

            <q-card-actions align="right">
                <q-btn color="primary" label="Добавить" type="submit"/>
                <q-btn color="grey" label="Отмена" @click="cancel"/>
            </q-card-actions>
        </q-form>
    </q-card>
</template>
