import { JSONResponse } from '@/js/types/response.types'
import apiRequest from '../js/utils/request'
import {
    AddWarehouseForm,
    UpdateWarehouseForm,
    Warehouse,
} from '@/js/types/warehouse.types'

export const getWarehouses = () =>
    apiRequest.get('warehouse').json<Warehouse[]>()

export const getWarehouse = (id: Number) =>
    apiRequest.get(`warehouse/${id}`).json<Warehouse>()

export const addWarehouse = (warehouse: AddWarehouseForm) =>
    apiRequest
        .post(`warehouse`, {
            json: warehouse,
        })
        .json<Warehouse>()

export const updateWarehouse = (warehouse: UpdateWarehouseForm) =>
    apiRequest
        .patch(`warehouse/${warehouse.id}`, {
            json: warehouse,
        })
        .json<Warehouse>()

export const deleteWarehouse = (id: Number) =>
    apiRequest.delete(`warehouse/${id}`).json<JSONResponse>()
