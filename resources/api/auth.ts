import apiRequest from '../js/utils/request'

export const login = (data: Object) =>
    apiRequest.post('login', {
        json: data,
    })

export const logout = () => apiRequest.get('logout', {})

export const register = (data: Object) =>
    apiRequest.post('register', {
        json: data,
    })


export const checkAuth = () => apiRequest.get('checkAuth')
