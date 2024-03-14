import { defineStore } from 'pinia'
import {
    addEmployee,
    deleteEmployee,
    getEmployee,
    getEmployees,
    updateEmployee,
} from '@/js/api/employee'
import {
    AddEmployeeForm,
    UpdateEmployeeForm,
    Employee,
} from '@/js/types/employee.types'

export const useEmployeesStore = defineStore({
    id: 'employeesStore',
    state: (): {
        employees: Employee[]
        selectedEmployee: Employee | null
    } => ({
        employees: [],
        selectedEmployee: null,
    }),
    actions: {
        async fetchGetEmployees(): Promise<Employee[]> {
            let res = await getEmployees()
            this.employees = await res
            return this.employees
        },

        async fetchGetEmployee(id: number): Promise<Employee> {
            return await getEmployee(id)
        },

        async fetchAddEmployee(employee: AddEmployeeForm) {
            return await addEmployee(employee)
        },

        async fetchUpdateEmployee(employee: UpdateEmployeeForm) {
            return await updateEmployee(employee)
        },

        async fetchDeleteEmployee(id: number) {
            return await deleteEmployee(id)
        },
    },
})
