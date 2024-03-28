export interface Employee {
    id: number
    fullName: string
    email: string
    roleId: number
    role: {
        id: number
        name: string
    }
    company_id: number
    created_at: Date
}

export type AddEmployeeForm = Pick<
    Employee,
    'fullName' | 'email' | 'roleId'
> & {
    password: string
    password_confirmation: string
}
export type UpdateEmployeeForm = Pick<
    Employee,
    'id' | 'fullName' | 'email' | 'roleId'
>
