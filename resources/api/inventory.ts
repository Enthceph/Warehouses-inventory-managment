import apiRequest from '../js/utils/request'

// TODO добавить return types
export const getInventories = () => apiRequest.get('inventory')
