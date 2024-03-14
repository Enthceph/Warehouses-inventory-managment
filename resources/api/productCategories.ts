import { JSONResponse } from '@/js/types/response.types'
import apiRequest from '../js/utils/request'
import {
    AddProductCategoryForm,
    ProductCategory,
    UpdateProductCategoryForm,
} from '@/js/types/productCategory.types'

export const getProductCategories = () =>
    apiRequest.get('productCategory').json<ProductCategory[]>()

export const getProductCategory = (id: Number) =>
    apiRequest.get(`productCategory/${id}`).json<ProductCategory>()

export const addProductCategory = (category: AddProductCategoryForm) =>
    apiRequest
        .post(`productCategory`, {
            json: category,
        })
        .json<ProductCategory>()

export const updateProductCategory = (category: UpdateProductCategoryForm) =>
    apiRequest
        .patch(`productCategory/${category.id}`, {
            json: category,
        })
        .json<ProductCategory>()

export const deleteProductCategory = (id: Number) =>
    apiRequest.delete(`productCategory/${id}`).json<JSONResponse>()
