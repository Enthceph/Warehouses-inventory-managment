export interface Employee {
    id: number
    full_name: string
    email: string
    role_id: number
    role: {
        id: number
        name: string
    }
    company_id: number
    created_at: Date
}

export interface AddEmployeeForm {
    full_name: Employee['full_name']
    email: Employee['email']
    password: string
    password_confirmation: string
    role_id: Employee['role_id']
}

export interface UpdateEmployeeForm {
    id: Employee['id']
    full_name?: Employee['full_name']
    email?: Employee['email']
    role_id?: Employee['role_id']
}
