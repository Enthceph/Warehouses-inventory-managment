import { defineStore } from 'pinia'
import {
    addOutlet,
    deleteOutlet,
    getOutlet,
    getOutlets,
    updateOutlet,
} from '@/js/api/outlet'
import { Outlet, OutletAddForm, OutletFormData } from '@/js/types/outlet.types'

export const useOutletsStore = defineStore({
    id: 'outletsStore',
    state: (): { outlets: Outlet[]; selectedOutlet: Outlet | null } => ({
        outlets: [],
        selectedOutlet: null,
    }),
    actions: {
        async fetchGetOutlets(): Promise<Outlet[]> {
            let res = await getOutlets()
            this.outlets = res.data
            return this.outlets
        },
        async fetchGetOutlet(id: number): Promise<Outlet> {
            let res = await getOutlet(id)
            return res.data
        },
        async fetchAddOutlet(outlet: OutletAddForm) {
            await addOutlet(outlet)
        },
        async fetchUpdateOutlet(id: number, outlet: OutletFormData) {
            await updateOutlet(id, outlet)
        },
        async fetchDeleteOutlet(id: number) {
            await deleteOutlet(id)
        },
    },
})
