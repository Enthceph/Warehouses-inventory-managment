import apiRequest from '../js/utils/request'

// TODO проверить на работоспособность
export const getUserCompany = () => apiRequest.get('company')

export const getCompany = (id: Number) => apiRequest.get(`company/${id}`)

export const addCompany = (data: Object) => apiRequest.post(`company`, {
    json: data,
})

export const updateCompany = (id: Number, data: Object) => apiRequest.patch(`company/${id}`, {
    json: data,
})

export const deleteCompany = (id: Number) => apiRequest.delete(`company/${id}`)
