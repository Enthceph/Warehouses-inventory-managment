import { JSONResponse, JSONResponseData } from '@/js/types/response.types'
import apiRequest from '../utils/request'
import {
    AddWarehouseForm,
    UpdateWarehouseForm,
    Warehouse,
} from '@/js/types/warehouse.types'

export const getWarehouses = () =>
    apiRequest.get('warehouse').json<JSONResponseData<Warehouse[]>>()

export const getWarehouse = (id: Number) =>
    apiRequest.get(`warehouse/${id}`).json<JSONResponseData<Warehouse>>()

export const addWarehouse = (warehouse: AddWarehouseForm) =>
    apiRequest
        .post(`warehouse`, {
            json: warehouse,
        })
        .json()

export const updateWarehouse = (warehouse: UpdateWarehouseForm) =>
    apiRequest
        .patch(`warehouse/${warehouse.id}`, {
            json: warehouse,
        })
        .json()

export const deleteWarehouse = (id: Number) =>
    apiRequest.delete(`warehouse/${id}`).json()
