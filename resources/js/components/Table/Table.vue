<script lang="ts" setup>
import TableHeader from "@/js/components/Table/TableHeader.vue";
import TableRow from "@/js/components/Table/TableRow.vue";
import TableCell from "@/js/components/Table/TableCell.vue";

const props = defineProps<{
    rows: object[]
    hideActionButtons?: Boolean
    hideAddButton?: Boolean
}>()

const emit = defineEmits(['rowEdit', 'rowDelete', 'rowAdd', 'rowClicked'])
</script>

<template>
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <TableHeader :hide-action-buttons="hideActionButtons" :row="props.rows[0]"/>

            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            <TableRow v-for="row in props.rows" :key="row.id">
                <TableCell v-for="cell in row" @click.self="emit('rowClicked', row)">
                    {{ cell }}
                </TableCell>

                <td v-if="!hideActionButtons">
                    <q-btn icon="mode_edit" @click="emit('rowEdit', row)"/>
                    <q-btn icon="delete" @click="emit('rowDelete', row)"/>
                </td>
            </TableRow>
            <tr v-if="!hideAddButton">
                <td class="px-6 py-4 text-center" colspan="100%">
                    <q-btn color="green-700" icon="add" round @click="emit('rowAdd')"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
