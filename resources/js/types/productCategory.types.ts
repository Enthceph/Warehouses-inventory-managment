export interface ProductCategory {
    id: number
    name: string
    created_at: Date
    updated_at: Date | null
    deleted_at: Date | null
}

export interface AddProductCategoryForm {
    name: ProductCategory['name']
}

export interface UpdateProductCategoryForm {
    id: ProductCategory['id']
    name: ProductCategory['name']
}
