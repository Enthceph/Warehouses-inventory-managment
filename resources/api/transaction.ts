import apiRequest from '../js/utils/request'

// TODO проверить на работоспособность
export const getTransactions = () => apiRequest.get('transaction')

export const getTransaction = (id: Number) => apiRequest.get(`transaction/${id}`)

export const addTransaction = (data: Object) => apiRequest.post(`transaction`, {
    json: data,
})

export const editTransaction = (id: Number, data: Object) => apiRequest.patch(`transaction/${id}`, {
    json: data,
})

export const deleteTransaction = (id: Number) => apiRequest.delete(`transaction/${id}`)
