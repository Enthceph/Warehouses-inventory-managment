import apiRequest from '../js/utils/request'

// TODO проверить на работоспособность
export const getEmployees = () => apiRequest.get('employee')

export const getEmployee = (id: Number) => apiRequest.get(`employee/${id}`)

export const addEmployee = (data: Object) => apiRequest.post(`employee`, {
    json: data,
})

export const editEmployee = (id: Number, data: Object) => apiRequest.patch(`employee/${id}`, {
    json: data,
})

export const deleteEmployee = (id: Number) => apiRequest.delete(`employee/${id}`)
