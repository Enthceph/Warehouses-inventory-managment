import { JSONResponse } from '@/js/types/response.types'
import apiRequest from '../js/utils/request'
import {
    AddEmployeeForm,
    Employee,
    UpdateEmployeeForm,
} from '@/js/types/employee.types'

export const getEmployees = () => apiRequest.get('employee').json<Employee[]>()

export const getEmployee = (id: Number) =>
    apiRequest.get(`employee/${id}`).json<Employee>()

export const addEmployee = (employee: AddEmployeeForm) =>
    apiRequest
        .post(`employee`, {
            json: employee,
        })
        .json<Employee>()

export const updateEmployee = (employee: UpdateEmployeeForm) =>
    apiRequest
        .patch(`employee/${employee.id}`, {
            json: employee,
        })
        .json<Employee>()

export const deleteEmployee = (id: Number) =>
    apiRequest.delete(`employee/${id}`).json<JSONResponse>()
