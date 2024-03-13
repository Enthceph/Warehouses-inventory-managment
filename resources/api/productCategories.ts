import apiRequest from '../js/utils/request'
import {
    AddProductCategoryForm,
    UpdateProductCategoryForm,
} from '@/js/types/productCategory.types'

export const getProductCategories = () => apiRequest.get('productCategory')

export const getProductCategory = (id: Number) =>
    apiRequest.get(`productCategory/${id}`)

export const addProductCategory = (category: AddProductCategoryForm) =>
    apiRequest.post(`productCategory`, {
        json: category,
    })

export const updateProductCategory = (category: UpdateProductCategoryForm) =>
    apiRequest.patch(`productCategory/${category.id}`, {
        json: category,
    })

export const deleteProductCategory = (id: Number) =>
    apiRequest.delete(`productCategory/${id}`)
