<script lang="ts" setup>
import Table from '@/js/components/Table/Table.vue'
import { useAuthStore } from '@/js/stores/auth'

import { useProductCategoriesStore } from '@/js/stores/productCategories'
import AddProductCategoryForm from '@/js/components/Forms/ProductCategory/AddProductCategoryForm.vue'
import UpdateProductCategoryForm from '@/js/components/Forms/ProductCategory/UpdateProductCategoryForm.vue'
import DeleteProductCategoryForm from '@/js/components/Forms/ProductCategory/DeleteProductCategoryForm.vue'

const productCategoriesStore = useProductCategoriesStore()
const authStore = useAuthStore()

onMounted(async () => {
    await productCategoriesStore.fetchGetProductCategories()
})

const columnNames = ['id', 'Name']

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
        <template v-slot:addForm="{ submit, cancel }" #addForm>
            <AddProductCategoryForm @cancel="cancel" @submit="submit" />
        </template>

        <template v-slot:updateForm="{ submit, cancel, selected }" #updateForm>
            <UpdateProductCategoryForm
                :category="selected"
                @cancel="cancel"
                @submit="submit"
            />
        </template>

        <template v-slot:deleteForm="{ submit, cancel, selected }" #deleteForm>
            <DeleteProductCategoryForm
                :category="selected"
                @cancel="cancel"
                @submit="submit"
            />
        </template>
    </Table>
</template>
