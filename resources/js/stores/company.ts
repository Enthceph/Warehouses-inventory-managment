import { defineStore } from 'pinia'
import { getCompany, getUserCompany, updateCompany } from '@/js/api/company'
import { Company, CompanyForUpdate } from '@/js/types/company.types'

export const useCompanyStore = defineStore({
    id: 'companyStore',
    state: (): Company => ({
        id: 0,
        name: '',
        address: '',
        contact_info: '',
    }),
    getters: {},
    actions: {
        async fetchCompany() {
            const company = await getUserCompany()
            this.setCompany(company)
            return company
        },
        async fetchGetCompany(id: Number) {
            return await getCompany(id)
        },
        async fetchUpdateCompany(id: number, company: CompanyForUpdate) {
            let updatedCompany = await updateCompany(id, company)
            this.setCompany(updatedCompany)
            return updatedCompany
        },
        setCompany(company: Company) {
            this.id = company.id
            this.name = company.name
            this.address = company.address
            this.contact_info = company.contact_info
        },
        clearCompany() {
            this.id = 0
            this.name = ''
            this.address = ''
            this.contact_info = ''
        },
    },
})
