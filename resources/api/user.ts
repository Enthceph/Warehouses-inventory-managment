import apiRequest from "../js/utils/request";

// TODO убрать вообще users(оставить только auth и employees)
export const getUsers = () => apiRequest.get('user')
export const getUser = (id: Number) => apiRequest.get(`user/${id}`)

export const user = () => apiRequest.get('user')


