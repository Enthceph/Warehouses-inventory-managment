import { Product, ProductFormData } from '@/js/types/product.types'
import apiRequest from '../utils/request'
import { JSONResponseData } from '@/js/types/response.types'

export const getProducts = () =>
    apiRequest.get('product').json<JSONResponseData<Product[]>>()

export const getProduct = (id: Number) =>
    apiRequest.get(`product/${id}`).json<JSONResponseData<Product>>()

export const addProduct = (product: ProductFormData) =>
    apiRequest
        .post(`product`, {
            json: product,
        })
        .json()

export const updateProduct = (id: Number, product: ProductFormData) =>
    apiRequest
        .patch(`product/${id}`, {
            json: product,
        })
        .json()

export const deleteProduct = (id: Number) =>
    apiRequest.delete(`product/${id}`).json()
