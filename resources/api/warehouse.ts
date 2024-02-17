import apiRequest from '../js/utils/request'
import {AddWarehouseForm, EditWarehouseForm} from "@/js/types/warehouse.types";

export const getWarehouses = () => apiRequest.get('warehouse')

export const getWarehouse = (id: Number) => apiRequest.get(`warehouse/${id}`)

export const addWarehouse = (warehouse: AddWarehouseForm) => apiRequest.post(`warehouse`, {
    json: warehouse,
})

export const updateWarehouse = (warehouse: EditWarehouseForm) => apiRequest.patch(`warehouse/${warehouse.id}`, {
    json: warehouse,
})

export const deleteWarehouse = (id: Number) => apiRequest.delete(`warehouse/${id}`)
