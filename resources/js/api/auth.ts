import { UserForm } from '@/js/types/user.types'
import apiRequest from '../utils/request'
import { AuthUser, LoginForm, LoginResponse } from '@/js/types/auth.types'
import { CompanyForm } from '@/js/types/company.types'
import { JSONResponse } from '@/js/types/response.types'

export const login = (data: LoginForm) =>
    apiRequest.post('login', { json: data }).json<LoginResponse>()

export const logout = () => apiRequest.delete('logout', undefined)

export const register = (registrationForm: {
    user: UserForm
    company: CompanyForm
}) =>
    apiRequest.post('register', { json: registrationForm }).json<JSONResponse>()

export const checkAuth = () =>
    apiRequest.get('checkAuth').json<{ authenticated: boolean }>()

export const getAuthUser = () => apiRequest.get('getAuthUser').json<AuthUser>()

export const changeName = (data: { name: AuthUser['full_name'] }) =>
    apiRequest.patch('changeName', { json: data }).json<JSONResponse>()

export const changeEmail = (data: { email: AuthUser['email'] }) =>
    apiRequest.patch('changeEmail', { json: data }).json<JSONResponse>()

export const changePassword = (data: {
    new_password: string
    old_password: string
    password_confirmation: string
}) => apiRequest.patch('changePassword', { json: data }).json<JSONResponse>()
