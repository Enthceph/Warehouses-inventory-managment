<script lang="ts" setup>
import Table from "@/js/components/Table/Table.vue";
import {useAuthStore} from "@/js/stores/auth";
import {Product} from "@/js/types/product.types";

import {useDialogPluginComponent} from 'quasar'
import {useProductCategoriesStore} from "@/js/stores/productCategories";
import AddProductCategoryForm from "@/js/components/Forms/ProductCategory/AddProductCategoryForm.vue";
import EditProductCategoryForm from "@/js/components/Forms/ProductCategory/EditProductCategoryForm.vue";
import DeleteProductCategoryForm from "@/js/components/Forms/ProductCategory/DeleteProductCategoryForm.vue";

defineEmits([...useDialogPluginComponent.emits]);
const {dialogRef, onDialogHide} = useDialogPluginComponent()

const router = useRouter()
const route = useRoute()
const productCategoriesStore = useProductCategoriesStore()
const authStore = useAuthStore()

const showAddProductCategoryModal = ref(false)
const showEditProductCategoryModal = ref(false)
const showDeleteProductCategoryModal = ref(false)

onMounted(async () => {
    await productCategoriesStore.fetchGetProductCategories()
})

// TABLE EMITS
const onRowAdd = () => {
    showAddProductCategoryModal.value = true
}

const onRowEdit = (row: Product) => {
    productCategoriesStore.selectedCategory = row
    showEditProductCategoryModal.value = true
}

const onRowDelete = (row: Product) => {
    productCategoriesStore.selectedCategory = row
    showDeleteProductCategoryModal.value = true
}

const onRowClicked = (row: Product) => {
    router.push(`/products/${row.id}`)
}

const columnNames = [
    'id',
    'Name',
]

const tableData = computed(() => {
    return productCategoriesStore.categories.map((category, index) => {
        return {
            id: category.id,
            name: category.name,
        }
    })
})


</script>

<template>
    <Table
        :column-names="columnNames"
        :data="tableData"
        :hide-action-buttons="authStore.role !== 'Owner'"
        @rowAdd="onRowAdd"
        @rowClicked="onRowClicked"
        @rowDelete="onRowDelete"
        @rowEdit="onRowEdit"
    />

    <!--    MODALS    -->

    <q-dialog ref="dialogRef" v-model="showAddProductCategoryModal" @hide="onDialogHide">
        <AddProductCategoryForm
            @cancel="showAddProductCategoryModal = false"
            @submitted="showAddProductCategoryModal = false"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showEditProductCategoryModal" @hide="onDialogHide">
        <EditProductCategoryForm
            @cancel="showEditProductCategoryModal = false"
            @submitted="showEditProductCategoryModal = false"
        />
    </q-dialog>

    <q-dialog ref="dialogRef" v-model="showDeleteProductCategoryModal" @hide="onDialogHide">
        <DeleteProductCategoryForm
            @cancel="showDeleteProductCategoryModal = false"
            @submitted="showDeleteProductCategoryModal = false"
        />
    </q-dialog>
</template>
