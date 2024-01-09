import apiRequest from '../js/utils/request'

// TODO проверить на работоспособность
export const getWarehouses = () => apiRequest.get('warehouse')

export const getWarehouse = (id: Number) => apiRequest.get(`warehouse/${id}`)

export const addWarehouse = (data: Object) => apiRequest.post(`warehouse`, {
    json: data,
})

export const editWarehouse = (id: Number, data: Object) => apiRequest.patch(`warehouse/${id}`, {
    json: data,
})

export const deleteWarehouse = (id: Number) => apiRequest.delete(`warehouse/${id}`)
