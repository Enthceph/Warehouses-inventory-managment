import {defineStore} from 'pinia';
import {getCompany, getUserCompany, updateCompany} from "@/api/company";
import {Company, CompanyForEdit} from "@/js/types/company.types";


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
            const company = await getUserCompany().json() as Company
            this.setCompany(company)
            return company
        },
        async fetchGetCompany(id: Number) {
            return await getCompany(id).json()
        },
        async fetchUpdateCompany(id: number, company: CompanyForEdit) {
            let edittedCompany = await updateCompany(id, company).json() as Company
            this.setCompany(edittedCompany)
            return edittedCompany
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
        }
    },
});
