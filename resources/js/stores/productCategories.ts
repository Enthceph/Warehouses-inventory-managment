import { defineStore } from 'pinia'
import {
    addProductCategory,
    deleteProductCategory,
    getProductCategories,
    getProductCategory,
    updateProductCategory,
} from '@/api/productCategories'
import {
    AddProductCategoryForm,
    UpdateProductCategoryForm,
    ProductCategory,
} from '@/js/types/productCategory.types'

interface ProductCategoriesStore {
    categories: ProductCategory[]
    selectedCategory: ProductCategory | null
    loading: boolean
}

export const useProductCategoriesStore = defineStore({
    id: 'productCategoriesStore',
    state: (): ProductCategoriesStore => ({
        categories: [],
        selectedCategory: null,
        loading: true,
    }),
    actions: {
        async fetchGetProductCategories(): Promise<ProductCategory[]> {
            this.loading = true

            let res = await getProductCategories()
            this.categories = await res

            this.loading = false

            return this.categories
        },
        async fetchGetProductCategory(id: number): Promise<ProductCategory> {
            let res = await getProductCategory(id)
            return await res
        },
        async fetchAddProductCategory(category: AddProductCategoryForm) {
            await addProductCategory(category)
            await this.fetchGetProductCategories()
        },
        async fetchUpdateProductCategory(category: UpdateProductCategoryForm) {
            await updateProductCategory(category)
            await this.fetchGetProductCategories()
        },
        async fetchDeleteProductCategory(id: number) {
            await deleteProductCategory(id)
            await this.fetchGetProductCategories()
        },
    },
})
