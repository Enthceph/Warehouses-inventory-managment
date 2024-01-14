<script lang="ts" setup>
import {useOutletsStore} from "@/js/stores/outlets";

const emit = defineEmits(['submitted', 'cancel'])
const outletStore = useOutletsStore()
const loading = ref(false)

const submit = async () => {
    loading.value = true

    try {
        if (outletStore.selectedOutlet) {
            await outletStore.fetchDeleteOutlet(outletStore.selectedOutlet.id)
        }
    } catch (err) {
        console.log('DeleteOutletForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submitted')

    await outletStore.fetchGetOutlets()
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <q-card>
        <transition
            appear
            enter-active-class="animated fadeIn"
            leave-active-class="animated fadeOut"
        >
            <div>
                <q-card-section>
                    Вы действительно хотите удалить точку {{ outletStore.selectedOutlet.name }}?
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn
                        color="grey"
                        label="Отмена"
                        @click="cancel"
                    />
                    <q-btn
                        color="red"
                        label="Удалить"
                        type="submit"
                        @click="submit"
                    />
                </q-card-actions>
            </div>
        </transition>
        <q-inner-loading :showing="loading"/>
    </q-card>
</template>
