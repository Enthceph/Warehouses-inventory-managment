export interface ProductCategory {
    id: number
    name: string
    created_at: Date
    updated_at: Date | null
    deleted_at: Date | null
}

export type AddProductCategoryForm = Pick<ProductCategory, 'name'>

export type UpdateProductCategoryForm = Pick<ProductCategory, 'id' | 'name'>
