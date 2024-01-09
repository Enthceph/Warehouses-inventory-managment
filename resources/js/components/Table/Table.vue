<script lang="ts" setup>
import TableHeader from "@/js/components/Table/TableHeader.vue";
import TableRow from "@/js/components/Table/TableRow.vue";
import TableCell from "@/js/components/Table/TableCell.vue";

const props = defineProps<{
    rows: object[]
    hideActionButtons?: Boolean
}>()

const emit = defineEmits(['rowEdit', 'rowDelete'])
</script>

<template>
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <TableHeader :hide-action-buttons="hideActionButtons" :row="props.rows[0]"/>

            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            <TableRow v-for="row in props.rows">
                <TableCell v-for="cell in row">
                    {{ cell }}
                </TableCell>
                <q-td v-if="!hideActionButtons">
                    <q-btn icon="mode_edit" @click="emit('rowEdit', row)"></q-btn>
                    <q-btn icon="delete" @click="emit('rowDelete', row)"></q-btn>
                </q-td>
            </TableRow>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
