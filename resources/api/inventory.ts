import { JSONResponse } from '@/js/types/response.types'
import apiRequest from '../js/utils/request'
import {
    AnalyticsFilterOptions,
    Inventory,
    InventoryFormData,
} from '@/js/types/inventory.types'

export const getInventories = (params?: { [key: string]: string | number }) =>
    apiRequest
        .get('inventory', {
            searchParams: params,
        })
        .json<Inventory[]>()

export const getInventory = (id: Number) =>
    apiRequest.get(`inventory/${id}`).json<Inventory>()

export const addInventory = (data: InventoryFormData) =>
    apiRequest
        .post(`inventory`, {
            json: data,
        })
        .json<Inventory>()

export const updateInventory = (id: Number, data: InventoryFormData) =>
    apiRequest
        .patch(`inventory/${id}`, {
            json: data,
        })
        .json<Inventory>()

export const deleteInventory = (id: Number) =>
    apiRequest.delete(`inventory/${id}`).json<JSONResponse>()

export const getAnalyticsFilterInfo = () =>
    apiRequest.get('getAnalyticsFilterInfo').json<AnalyticsFilterOptions>()
