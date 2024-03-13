import apiRequest from '../js/utils/request'
import { AddEmployeeForm, UpdateEmployeeForm } from '@/js/types/employee.types'

// TODO проверить на работоспособность
export const getEmployees = () => apiRequest.get('employee')

export const getEmployee = (id: Number) => apiRequest.get(`employee/${id}`)

export const addEmployee = (employee: AddEmployeeForm) =>
    apiRequest.post(`employee`, {
        json: employee,
    })

export const updateEmployee = (employee: UpdateEmployeeForm) =>
    apiRequest.patch(`employee/${employee.id}`, {
        json: employee,
    })

export const deleteEmployee = (id: Number) =>
    apiRequest.delete(`employee/${id}`)
