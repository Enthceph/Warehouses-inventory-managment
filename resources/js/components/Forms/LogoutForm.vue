<script lang="ts" setup>

const emit = defineEmits(['submit', 'cancel'])

const submit = () => {
    emit('submit')
}

const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <q-card>
        <q-card-section>
            Вы действительно хотите выйти?
        </q-card-section>

        <q-card-actions align="right">
            <q-btn
                color="grey"
                label="Отмена"
                @click="cancel"
            />
            <q-btn
                color="red"
                label="Выйти"
                type="submit"
                @click="submit"
            />
        </q-card-actions>
    </q-card>
</template>
