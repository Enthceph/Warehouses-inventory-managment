import { Outlet, OutletAddForm, OutletFormData } from '@/js/types/outlet.types'
import apiRequest from '../js/utils/request'
import { JSONResponse } from '@/js/types/response.types'

export const getOutlets = () => apiRequest.get('outlet').json<Outlet[]>()

export const getOutlet = (id: Number) =>
    apiRequest.get(`outlet/${id}`).json<Outlet>()

export const addOutlet = (outlet: OutletAddForm) =>
    apiRequest
        .post(`outlet`, {
            json: outlet,
        })
        .json<Outlet>()

export const updateOutlet = (id: Number, outlet: OutletFormData) =>
    apiRequest
        .patch(`outlet/${id}`, {
            json: outlet,
        })
        .json<Outlet>()

export const deleteOutlet = (id: Number) =>
    apiRequest.delete(`outlet/${id}`).json<JSONResponse>()
