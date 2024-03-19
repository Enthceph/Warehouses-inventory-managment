import { ProductCategory } from '@/js/types/productCategory.types'

export interface Product {
    id: number
    name: string
    additional_info: string | null
    company_id: number
    category_id: number
    created_at: Date
    updated_at: Date | null
    deleted_at: Date | null
    category: ProductCategory
}

export type ProductFormData = Pick<Product, 'name' | 'additional_info'> & {
    category_id: Product['category_id'] | null
}
