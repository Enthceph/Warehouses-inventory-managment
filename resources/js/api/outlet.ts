import { Outlet, OutletAddForm, OutletFormData } from '@/js/types/outlet.types'
import apiRequest from '../utils/request'
import { JSONResponseData } from '@/js/types/response.types'

export const getOutlets = () =>
    apiRequest.get('outlet').json<JSONResponseData<Outlet[]>>()

export const getOutlet = (id: Number) =>
    apiRequest.get(`outlet/${id}`).json<JSONResponseData<Outlet>>()

export const addOutlet = (outlet: OutletAddForm) =>
    apiRequest
        .post(`outlet`, {
            json: outlet,
        })
        .json()

export const updateOutlet = (id: Number, outlet: OutletFormData) =>
    apiRequest
        .patch(`outlet/${id}`, {
            json: outlet,
        })
        .json()

export const deleteOutlet = (id: Number) =>
    apiRequest.delete(`outlet/${id}`).json()
