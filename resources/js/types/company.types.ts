export interface Company {
    id: number
    name: string
    address: string
    contact_info: string
}

export interface CompanyForUpdate {
    name?: string
    address?: string
    contact_info?: string
}

export type CompanyForm = Omit<Company, 'id'>
