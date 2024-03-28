import { defineStore } from 'pinia'
import {
    addProduct,
    deleteProduct,
    getProduct,
    getProducts,
    updateProduct,
} from '@/js/api/product'
import { Product, ProductFormData } from '@/js/types/product.types'

interface ProductsStore {
    products: Product[]
}

export const useProductsStore = defineStore({
    id: 'productsStore',
    state: (): ProductsStore => ({
        products: [],
    }),
    actions: {
        async fetchGetProducts(): Promise<Product[]> {
            let res = await getProducts()
            this.products = res.data

            return this.products
        },
        async fetchGetProduct(id: number): Promise<Product> {
            let res = await getProduct(id)

            return res.data
        },
        async fetchAddProduct(product: ProductFormData) {
            await addProduct(product)
            await this.fetchGetProducts()
        },
        async fetchUpdateProduct(id: number, product: ProductFormData) {
            await updateProduct(id, product)
            await this.fetchGetProducts()
        },
        async fetchDeleteProduct(id: number) {
            await deleteProduct(id)
            await this.fetchGetProducts()
        },
    },
})
