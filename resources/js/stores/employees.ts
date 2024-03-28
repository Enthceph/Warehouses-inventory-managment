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
            const res = await getEmployees()
            this.employees = res.data
            return this.employees
        },

        async fetchGetEmployee(id: number): Promise<Employee> {
            const res = await getEmployee(id)
            return res.data
        },

        async fetchAddEmployee(employee: AddEmployeeForm) {
            await addEmployee(employee)
        },

        async fetchUpdateEmployee(employee: UpdateEmployeeForm) {
            await updateEmployee(employee)
        },

        async fetchDeleteEmployee(id: number) {
            await deleteEmployee(id)
        },
    },
})
