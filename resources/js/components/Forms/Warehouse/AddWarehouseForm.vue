<script lang="ts" setup>
export interface Warehouse {
    name: string
    location?: string
    contact_info?: string
}

const emit = defineEmits(['submit', 'cancel'])
const form = ref()
const data = reactive<Warehouse>({
    name: '',
    location: '',
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
                <h2 class="text-h5 text-center">Добавить склад</h2>
            </q-card-section>

            <q-card-section>
                <q-form ref="add_warehouse_form" autocomplete="off" @submit.prevent="">
                    <q-input
                        v-model="data.name"
                        :rules="[v => v.length >= 2 || `Название склада должно иметь хотя бы 2 буквы`]"
                        hide-bottom-space
                        label="Warehouse name"
                        placeholder="Enter warehouse name"
                        required
                    />

                    <q-input
                        v-model="data.location"
                        label="Warehouse Location"
                        placeholder="Enter warehouse location"
                    />

                    <q-input
                        v-model="data.contact_info"
                        label="Contact Information"
                        placeholder="Enter contact information"
                    />
                </q-form>
            </q-card-section>

            <q-card-actions align="right">
                <q-btn color="grey" label="Отмена" @click="cancel"/>
                <q-btn color="primary" label="Добавить" type="submit"/>
            </q-card-actions>
        </q-form>
    </q-card>
</template>
