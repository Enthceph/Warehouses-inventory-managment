import apiRequest from '../js/utils/request'

export const getOutlets = () => apiRequest.get('outlet')

export const getOutlet = (id: Number) => apiRequest.get(`outlet/${id}`)

export const addOutlet = (data: Object) => apiRequest.post(`outlet`, {
    json: data,
})

export const updateOutlet = (id: Number, data: Object) => apiRequest.patch(`outlet/${id}`, {
    json: data,
})

export const deleteOutlet = (id: Number) => apiRequest.delete(`outlet/${id}`)

