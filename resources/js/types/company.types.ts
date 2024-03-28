export interface Company {
    id: number
    name: string
    address: string
    contactInfo: string
}

export interface CompanyForUpdate {
    name?: string
    address?: string
    contactInfo?: string
}

export type CompanyForm = Omit<Company, 'id'>
