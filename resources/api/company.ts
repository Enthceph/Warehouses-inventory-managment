import { Company, CompanyForUpdate } from '@/js/types/company.types'
import apiRequest from '../js/utils/request'
import { JSONResponse } from '@/js/types/response.types'

export const getUserCompany = () => apiRequest.get('company').json<Company>()

export const getCompany = (id: Number) =>
    apiRequest.get(`company/${id}`).json<Company>()

export const addCompany = (company: Company) =>
    apiRequest
        .post(`company`, {
            json: company,
        })
        .json<JSONResponse>()

export const updateCompany = (id: Number, company: CompanyForUpdate) =>
    apiRequest
        .patch(`company/${id}`, {
            json: company,
        })
        .json<Company>()

export const deleteCompany = (id: Number) =>
    apiRequest.delete(`company/${id}`).json<JSONResponse>()
