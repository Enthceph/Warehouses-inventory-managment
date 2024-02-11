export interface Employee {
    id: number
    full_name: string
    email: string
    role_id: number
    company_id: number
    created_at: Date
}

export interface AddEmployeeForm {
    full_name: string
    email: string
    password: string
    password_confirmation: string
    role_id: number
}

export interface EmployeeForEdit {
    id: number
    full_name?: string
    email?: string
    role_id?: number
}
