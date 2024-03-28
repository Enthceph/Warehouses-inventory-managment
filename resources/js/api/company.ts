import { Company, CompanyForUpdate } from '@/js/types/company.types'
import apiRequest from '../utils/request'
import { JSONResponseData } from '@/js/types/response.types'

export const getUserCompany = () =>
    apiRequest.get('company').json<JSONResponseData<Company>>()

export const getCompany = (id: Number) =>
    apiRequest.get(`company/${id}`).json<JSONResponseData<Company>>()

export const addCompany = (company: Company) =>
    apiRequest
        .post(`company`, {
            json: company,
        })
        .json()

export const updateCompany = (id: Number, company: CompanyForUpdate) =>
    apiRequest
        .patch(`company/${id}`, {
            json: company,
        })
        .json()

export const deleteCompany = (id: Number) =>
    apiRequest.delete(`company/${id}`).json()
