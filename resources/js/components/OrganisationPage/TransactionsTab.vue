<script lang="ts" setup>
import {useDialogPluginComponent} from 'quasar'
import TabAddButton from "@/js/components/OrganisationPage/TabAddButton.vue";
import {useFetching} from "@/js/composables/useFetching";
import {addTransaction, getTransactions} from "@/api/transaction";
import AddTransactionForm, {Transaction} from "@/js/components/Forms/AddTransactionForm.vue";

defineEmits([...useDialogPluginComponent.emits])
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const showAddTransactionModal = ref(false)

const {fetch: fetchGetTransactions, data: transactions} = useFetching(getTransactions)

const {fetch: fetchAddTransaction} = useFetching(addTransaction)


const onAddTransactionFormSubmit = async (data: Transaction) => {

    await fetchAddTransaction(data)
    await fetchGetTransactions()
}
onMounted(async () => {
    await fetchGetTransactions()
})
</script>

<template>
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

        <q-tr v-for="transaction of transactions.data" v-if="transactions" class="text-center">
            <!--            <q-td>{{ transaction.id }}</q-td>-->
            <!--            <q-td>{{ transaction.amount }}</q-td>-->
            <!--            <q-td>{{ transaction.description }}</q-td>-->
            <!--            <q-td>{{ transaction.type }}</q-td>-->
            <!--            <q-td>{{ transaction.outlet }}</q-td>-->
            <!--            <q-td>{{ transaction.product }}</q-td>-->
            <!--            <q-td>{{ transaction.created_at }}</q-td>-->

            <q-td>{{ transaction.created_at || 1 }}</q-td>
            <q-td>{{ transaction.amount }}</q-td>
            <q-td>{{ transaction.outlet }}</q-td>
            <q-td>{{ transaction.product }}</q-td>
        </q-tr>
        </tbody>
    </q-markup-table>
    <TabAddButton @click="showAddTransactionModal = true"/>

    <!--    MODALS   -->

    <q-dialog ref="dialogRef" v-model="showAddTransactionModal" @hide="onDialogHide">
        <AddTransactionForm
            @cancel="showAddTransactionModal = false"
            @submit="onAddTransactionFormSubmit"
        />
    </q-dialog>
</template>
