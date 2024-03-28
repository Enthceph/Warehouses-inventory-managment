import { defineStore } from 'pinia'
import { getCompany, getUserCompany, updateCompany } from '@/js/api/company'
import { Company, CompanyForUpdate } from '@/js/types/company.types'

export const useCompanyStore = defineStore({
    id: 'companyStore',
    state: (): Company => ({
        id: 0,
        name: '',
        address: '',
        contactInfo: '',
    }),
    getters: {},
    actions: {
        async fetchCompany() {
            const res = await getUserCompany()
            this.setCompany(res.data)

            return res.data
        },
        async fetchGetCompany(id: Number) {
            const res = await getCompany(id)

            return res.data
        },
        async fetchUpdateCompany(id: number, company: CompanyForUpdate) {
            let updatedCompany = await updateCompany(id, company)
            this.fetchCompany()

            return updatedCompany
        },
        setCompany(company: Company) {
            this.id = company.id
            this.name = company.name
            this.address = company.address
            this.contactInfo = company.contactInfo
        },
        clearCompany() {
            this.id = 0
            this.name = ''
            this.address = ''
            this.contactInfo = ''
        },
    },
})
