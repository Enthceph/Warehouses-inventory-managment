<script lang="ts" setup>
import TableHeader from "@/js/components/Table/TableHeader.vue";
import TableRow from "@/js/components/Table/TableRow.vue";
import TableCell from "@/js/components/Table/TableCell.vue";

const props = defineProps<{
    columnNames: object[],
    data: object[],
    hideActionButtons?: Boolean
}>()

const emit = defineEmits(['rowEdit', 'rowDelete', 'rowAdd', 'rowClicked'])
</script>

<template>
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <TableHeader :hide-action-buttons="hideActionButtons" :names="props.columnNames"/>

            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            <TableRow v-for="row in props.data" :key="row.id">
                <TableCell v-for="cell in row" @click.self="emit('rowClicked', row)">
                    {{ cell }}
                </TableCell>

                <td v-if="!props.hideActionButtons" class="action-buttons">
                    <q-btn class="btn-edit" flat icon="mode_edit" @click="emit('rowEdit', row)"/>
                    <q-btn class="btn-delete" flat icon="delete" @click="emit('rowDelete', row)"/>
                </td>
            </TableRow>
            <tr v-if="!props.hideActionButtons">
                <td class="px-6 py-4 text-center" colspan="100%">
                    <q-btn class="add-button" icon="add" round @click="emit('rowAdd')"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<style scoped>
.action-buttons {

}

.add-button {
    color: lime;
}

.btn-edit {
    color: orange;
}

.btn-delete {
    color: rgb(199 55 44);
}
</style>
