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
        :columns="tableData"
        :data="productCategoriesStore.categories"
        :hide-action-buttons="authStore.role !== 'Owner'"
    >
        <template v-slot:addForm="{submit, cancel}" #addForm>
            <AddProductCategoryForm @cancel="cancel" @submit="submit"/>
        </template>

        <template v-slot:editForm="{submit, cancel, selected}" #editForm>
            <EditProductCategoryForm :category="selected" @cancel="cancel" @submit="submit"/>
        </template>

        <template v-slot:deleteForm="{submit, cancel , selected}" #deleteForm>
            <DeleteProductCategoryForm :category="selected" @cancel="cancel" @submit="submit"/>
        </template>
    </Table>

</template>
