<script lang="ts" setup>
import UpdateProductForm from '@/js/components/Forms/Product/UpdateProductForm.vue'
import Table from '@/js/components/Table/Table.vue'
import AddProductForm from '@/js/components/Forms/Product/AddProductForm.vue'
import DeleteProductForm from '@/js/components/Forms/Product/DeleteProductForm.vue'
import { useProductsStore } from '@/js/stores/products'
import { useAuthStore } from '@/js/stores/auth'

const productStore = useProductsStore()
const authStore = useAuthStore()

onMounted(async () => {
    await productStore.fetchGetProducts()
})

const columnNames = ['id', 'Name', 'Additional info', 'Category', 'Created']

const columns = computed(() =>
    productStore.products.map((product, index) => {
        return {
            id: product.id,
            name: product.name,
            additional_info: product.additional_info,
            category: product.category.name,
            created_at: new Date(product.created_at).toLocaleDateString(
                'ru-RU'
            ),
        }
    })
)
</script>

<template>
    <Table
        :column-names="columnNames"
        :columns="columns"
        :data="productStore.products"
        :hide-action-buttons="authStore.role !== 'Owner'"
    >
        <template v-slot:addForm="{ submit, cancel }" #addForm>
            <AddProductForm @cancel="cancel" @submit="submit" />
        </template>

        <template v-slot:updateForm="{ submit, cancel, selected }" #updateForm>
            <UpdateProductForm
                :product="selected"
                @cancel="cancel"
                @submit="submit"
            />
        </template>

        <template v-slot:deleteForm="{ submit, cancel, selected }" #deleteForm>
            <DeleteProductForm
                :product="selected"
                @cancel="cancel"
                @submit="submit"
            />
        </template>
    </Table>
</template>
