import apiRequest from '../js/utils/request'
import {AuthUser, LoginData, LoginResponse} from "@/js/types/auth.types";

export const login = (data: LoginData) => apiRequest.post('login', {json: data}).json<LoginResponse>();

export const logout = () => apiRequest.get('logout', undefined)

// TODO добавить тип
export const register = (data: Object) => apiRequest.post('register', {json: data})

export const checkAuth = () => apiRequest.get('checkAuth').json<{ authenticated: boolean }>()

export const getAuthUser = () => apiRequest.get('getAuthUser').json<AuthUser>();

export const changeName = (data: {
    name: AuthUser['full_name']
}) => apiRequest.patch('changeName', {json: data})

export const changeEmail = (data: {
    email: AuthUser['email']
}) => apiRequest.patch('changeEmail', {json: data})

export const changePassword = (data: {
    new_password: string
    old_password: string
    password_conformation: string
}) => apiRequest.patch('changePassword', {json: data})
