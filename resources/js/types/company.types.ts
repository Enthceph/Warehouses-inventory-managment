export interface Company {
    id: number
    name: string
    address: string
    contact_info: string
}

export interface CompanyForEdit {
    id: number
    name?: string
    address?: string
    contact_info?: string
}
