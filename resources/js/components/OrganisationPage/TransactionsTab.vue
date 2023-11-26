<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import TabAddButton from "@/js/components/OrganisationPage/TabAddButton.vue";
import {useFetching} from "@/js/composables/useFetching";
import {addTransaction, getTransactions} from "@/api/transaction";
import AddTransactionForm from "@/js/components/Forms/AddTransactionForm.vue";

const {fetch: fetchAddTransaction} = useFetching(addTransaction)

defineEmits([...useDialogPluginComponent.emits])
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const showAddTransactionModal = ref(false)


const {fetch: fetchGetTransactions, data: transactions} = useFetching(getTransactions)

onMounted(async () => {
    await fetchGetTransactions()
})
</script>

<template>
    {{ transactions }}
    <q-markup-table>
        <thead>
        <q-tr>
            <q-th>created_at</q-th>
            <q-th>amount</q-th>
            <q-th>outlet_id</q-th>
            <q-th>product</q-th>
        </q-tr>
        </thead>
        <tbody>
        <q-tr v-for="transaction of transactions">
            <q-td>{{ transaction.created_at }}</q-td>
            <q-td>{{ transaction.amount }}</q-td>
            <q-td>{{ transaction.outlet_id }}</q-td>
            <q-td>{{ transaction.product }}</q-td>

        </q-tr>
        </tbody>
    </q-markup-table>
    <TabAddButton @click="showAddTransactionModal = true"/>


    <!--    MODALS   -->

    <q-dialog ref="dialogRef" v-model="showAddTransactionModal" @hide="onDialogHide">
        <AddTransactionForm
            @cancel="showAddTransactionModal = false"
            @submit=""
        />
    </q-dialog>
</template>

<style scoped>

</style>
