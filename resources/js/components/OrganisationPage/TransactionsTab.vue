<script lang="ts" setup>
import TabAddButton from "@/js/components/OrganisationPage/TabAddButton.vue";
import {useFetching} from "@/js/composables/useFetching";
import {addTransaction} from "@/api/transaction";
import AddTransactionForm from "@/js/components/Forms/AddTransactionForm.vue";

const {fetch: fetchAddTransaction} = useFetching(addTransaction)
</script>

<template>
    <TabAddButton

    />

    <AddTransactionForm
        
    />

    <!--    MODALS   -->
</template>

<style scoped>

</style>
