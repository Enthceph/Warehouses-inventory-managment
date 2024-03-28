import { ProductCategory } from '@/js/types/productCategory.types'

export interface Product {
    id: number
    name: string
    additionalInfo: string | null
    createdAt: Date
    category: ProductCategory
}

export type ProductFormData = Pick<Product, 'name' | 'additionalInfo'> & {
    categoryId: number | null
}
