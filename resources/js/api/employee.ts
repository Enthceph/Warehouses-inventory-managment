import { JSONResponse, JSONResponseData } from '@/js/types/response.types'
import apiRequest from '../utils/request'
import {
    AddEmployeeForm,
    Employee,
    UpdateEmployeeForm,
} from '@/js/types/employee.types'

export const getEmployees = () =>
    apiRequest.get('employee').json<JSONResponseData<Employee[]>>()

export const getEmployee = (id: Number) =>
    apiRequest.get(`employee/${id}`).json<JSONResponseData<Employee>>()

export const addEmployee = (employee: AddEmployeeForm) =>
    apiRequest
        .post(`employee`, {
            json: employee,
        })
        .json()

export const updateEmployee = (employee: UpdateEmployeeForm) =>
    apiRequest
        .patch(`employee/${employee.id}`, {
            json: employee,
        })
        .json()

export const deleteEmployee = (id: Number) =>
    apiRequest.delete(`employee/${id}`).json()
