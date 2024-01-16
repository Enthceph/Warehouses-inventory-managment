import apiRequest from '../js/utils/request'

// TODO добавить return types и соответсвующий тип вместо data:Object
export const getWarehouses = () => apiRequest.get('warehouse')

export const getWarehouse = (id: Number) => apiRequest.get(`warehouse/${id}`)

export const addWarehouse = (data: Object) => apiRequest.post(`warehouse`, {
    json: data,
})

export const updateWarehouse = (id: Number, data: Object) => apiRequest.patch(`warehouse/${id}`, {
    json: data,
})
export const getWarehouseInventory = (data: Object) => apiRequest.post(`getWarehouseInventory`, {
    json: data,
})

export const deleteWarehouse = (id: Number) => apiRequest.delete(`warehouse/${id}`)
