import apiRequest from '../js/utils/request'
import {InventoryFormData} from "@/js/types/inventory.types";

// TODO добавить return types
export const getInventories = () => apiRequest.get('inventory')

export const getInventory = (id: Number) => apiRequest.get(`inventory/${id}`)

export const addInventory = (data: InventoryFormData) => apiRequest.post(`inventory`, {
    json: data,
})

export const updateInventory = (id: Number, data: InventoryFormData) => apiRequest.patch(`inventory/${id}`, {
    json: data,
})

export const deleteInventory = (id: Number) => apiRequest.delete(`inventory/${id}`)

