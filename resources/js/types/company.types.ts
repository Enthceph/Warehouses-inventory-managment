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

export interface CompanyForm {
    name: Company['name']
    address?: Company['address']
    contact_info?: Company['contact_info']
}
