import apiRequest from '../js/utils/request'

// TODO переделать типы в номральные
export const getProducts = () => apiRequest.get('product')

export const getProduct = (id: Number) => apiRequest.get(`product/${id}`)

export const addProduct = (data: Object) => apiRequest.post(`product`, {
    json: data,
})

export const updateProduct = (id: Number, data: Object) => apiRequest.patch(`product/${id}`, {
    json: data,
})

export const deleteProduct = (id: Number) => apiRequest.delete(`product/${id}`)

