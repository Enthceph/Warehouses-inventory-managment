import { JSONResponseData } from '@/js/types/response.types'
import apiRequest from '../utils/request'
import {
    AddProductCategoryForm,
    ProductCategory,
    UpdateProductCategoryForm,
} from '@/js/types/productCategory.types'

export const getProductCategories = () =>
    apiRequest
        .get('productCategory')
        .json<JSONResponseData<ProductCategory[]>>()

export const getProductCategory = (id: Number) =>
    apiRequest
        .get(`productCategory/${id}`)
        .json<JSONResponseData<ProductCategory>>()

export const addProductCategory = (category: AddProductCategoryForm) =>
    apiRequest
        .post(`productCategory`, {
            json: category,
        })
        .json()

export const updateProductCategory = (category: UpdateProductCategoryForm) =>
    apiRequest
        .patch(`productCategory/${category.id}`, {
            json: category,
        })
        .json()

export const deleteProductCategory = (id: Number) =>
    apiRequest.delete(`productCategory/${id}`).json()
