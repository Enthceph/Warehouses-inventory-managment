export interface ProductCategory {
    id: number
    name: string
}

export type AddProductCategoryForm = Pick<ProductCategory, 'name'>

export type UpdateProductCategoryForm = Pick<ProductCategory, 'id' | 'name'>
