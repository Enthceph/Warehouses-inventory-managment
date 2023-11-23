<script lang="ts" setup>
import {getDataForTransactionForm} from "@/api/organisation";
import {useFetching} from "@/js/composables/useFetching";

const emit = defineEmits(['submit', 'cancel'])
const form = ref()

export interface Transaction {
    'product': string
    'type_id': string
    'amount': number
    'description'?: string
    'outlet_id': number
    'warehouse_id': number
    'date': Date | null | string
}

const data = reactive<Transaction>({
    'product': '',
    'type_id': '',
    'amount': 0,
    'description': '',
    'outlet_id': 0,
    'warehouse_id': 0,
    'date': null,
})

const {fetch: fetchGetDataForTransactionForm, data: dataForForm} = useFetching(getDataForTransactionForm)

onMounted(async () => {
    data.date = new Date().toDateString()

    await fetchGetDataForTransactionForm()
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
    <q-card class="q-pa-md">
        <q-form v-if="dataForForm" ref="form" @submit.prevent="submit">
            <q-input
                v-model="data.product"
                label="Product"
                list="products"
                required
            >
                <datalist id="products">
                    <option v-for="product of dataForForm.products" :value="product.product_name"/>
                </datalist>
            </q-input>

            <q-select
                v-model="data.type_id"
                :options="dataForForm.categories"
                emit-value
                label="Type"
                map-options
                option-label="category"
                option-value="id"
                required
            />
            <q-input
                v-model.number="data.amount"
                label="Amount"
                required
                type="number"
            />
            <q-input
                v-model="data.description"
                label="Description"
            />

            <q-select
                v-model="data.outlet_id"
                :options="dataForForm.outlets"
                emit-value
                label="Outlet"
                map-options
                option-label="name"
                option-value="id"
                required
            />
            <q-select
                v-model="data.warehouse_id"
                :options="dataForForm.warehouses"
                emit-value
                label="Warehouse"
                map-options
                option-label="name"
                option-value="id"
                required
            />

            <q-input v-model="data.date" filled label="Date">
                <template v-slot:prepend>
                    <q-icon class="cursor-pointer" name="event">
                        <q-popup-proxy cover transition-hide="scale" transition-show="scale">
                            <q-date v-model="data.date" mask="YYYY-MM-DD HH:mm">
                                <div class="row items-center justify-end">
                                    <q-btn v-close-popup color="primary" flat label="Close"/>
                                </div>
                            </q-date>
                        </q-popup-proxy>
                    </q-icon>
                </template>

                <template v-slot:append>
                    <q-icon class="cursor-pointer" name="access_time">
                        <q-popup-proxy cover transition-hide="scale" transition-show="scale">
                            <q-time v-model="data.date" format24h mask="YYYY-MM-DD HH:mm">
                                <div class="row items-center justify-end">
                                    <q-btn v-close-popup color="primary" flat label="Close"/>
                                </div>
                            </q-time>
                        </q-popup-proxy>
                    </q-icon>
                </template>
            </q-input>
        </q-form>

        <q-card-actions align="between">
            <q-btn color="grey" label="Cancel" @click="cancel"/>
            <q-btn color="primary" label="Add" type="submit"/>
        </q-card-actions>
    </q-card>
</template>
