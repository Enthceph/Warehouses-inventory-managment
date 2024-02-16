import apiRequest from '../js/utils/request'

export const getProductCategories = () => apiRequest.get('productCategory')

export const getProductCategory = (id: Number) => apiRequest.get(`productCategory/${id}`)

export const addProductCategory = (data: Object) => apiRequest.post(`productCategory`, {
    json: data,
})

export const updateProductCategory = (id: Number, data: Object) => apiRequest.patch(`productCategory/${id}`, {
    json: data,
})

export const deleteProductCategory = (id: Number) => apiRequest.delete(`productCategory/${id}`)

