<script lang="ts" setup generic="T">
import TableHeader from '@/js/components/Table/TableHeader.vue'
import TableRow from '@/js/components/Table/TableRow.vue'
import TableCell from '@/js/components/Table/TableCell.vue'
import { useDialogPluginComponent } from 'quasar'

const props = defineProps<{
    columnNames: string[]
    data: {
        id: number
        [key: string]: string | number | null | object
    }[]
    columns: {
        id: number
        [key: string]: string | number | null | object
    }[]
    hideActionButtons?: boolean
}>()

const slots = defineSlots<{
    addForm?: (props: { submit: () => void; cancel: () => void }) => void

    updateForm?: <T>(props: {
        submit: () => void
        cancel: () => void
        selected: T
    }) => void

    deleteForm?: <T>(props: {
        submit: () => void
        cancel: () => void
        selected: T
    }) => void
}>()

const emit = defineEmits(['rowClicked', ...useDialogPluginComponent.emits])
const { dialogRef, onDialogHide } = useDialogPluginComponent()

const selectedRow = reactive<{
    [key: string]: string | number | null | object
}>({})

const addModal = ref(false)
const updateModal = ref(false)
const deleteModal = ref(false)

const showAddModal = () => {
    addModal.value = true
}

const showUpdateModal = (row: Object) => {
    Object.assign(selectedRow, row)
    updateModal.value = true
}

const showDeleteModal = (row: Object) => {
    Object.assign(selectedRow, row)
    deleteModal.value = true
}

const closeAddModal = () => {
    addModal.value = false
}

const closeUpdateModal = () => {
    Object.assign(selectedRow, {})
    updateModal.value = false
}

const closeDeleteModal = () => {
    Object.assign(selectedRow, {})
    deleteModal.value = false
}
</script>

<template>
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <table
            class="w-full border-collapse bg-white text-left text-sm text-gray-500"
        >
            <TableHeader
                :hide-action-buttons="!props.hideActionButtons"
                :names="props.columnNames"
            />

            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                <TableRow v-for="(row, index) in props.columns" :key="row.id">
                    <TableCell
                        v-for="cell in row"
                        @click.self="emit('rowClicked', props.data[index])"
                    >
                        {{ cell }}
                    </TableCell>

                    <td v-if="!props.hideActionButtons" class="action-buttons">
                        <div class="flex justify-end items-center">
                            <q-btn
                                class="btn-update"
                                flat
                                icon="mode_update"
                                @click="showUpdateModal(props.data[index])"
                            />
                            <q-btn
                                class="btn-delete"
                                flat
                                icon="delete"
                                @click="showDeleteModal(props.data[index])"
                            />
                        </div>
                    </td>
                </TableRow>

                <tr v-if="!props.hideActionButtons">
                    <td class="px-6 py-4 text-center" colspan="100%">
                        <q-btn
                            class="add-button"
                            icon="add"
                            round
                            @click="showAddModal"
                        />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!--    MODALS    -->

    <q-dialog ref="dialogRef" v-model="addModal" @hide="onDialogHide">
        <slot :cancel="closeAddModal" :submit="closeAddModal" name="addForm" />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="updateModal" @hide="onDialogHide">
        <slot
            :cancel="closeUpdateModal"
            :selected="selectedRow"
            :submit="closeUpdateModal"
            name="updateForm"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="deleteModal" @hide="onDialogHide">
        <slot
            :cancel="closeDeleteModal"
            :selected="selectedRow"
            :submit="closeDeleteModal"
            name="deleteForm"
        />
    </q-dialog>
</template>
<style scoped>
.add-button {
    color: lime;
}

.btn-update {
    color: orange;
}

.btn-delete {
    color: rgb(199 55 44);
}
</style>
