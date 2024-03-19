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

export type AddEmployeeForm = Pick<
    Employee,
    'full_name' | 'email' | 'role_id'
> & {
    password: string
    password_confirmation: string
}
export type UpdateEmployeeForm = Pick<
    Employee,
    'id' | 'full_name' | 'email' | 'role_id'
>
