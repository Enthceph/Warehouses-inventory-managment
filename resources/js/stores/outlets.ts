import {defineStore} from 'pinia';
import {addOutlet, deleteOutlet, getOutlet, getOutlets, updateOutlet} from "@/api/outlet";
import {Outlet, OutletForEdit, OutletFormData} from "@/js/types/outlet.types";

export const useOutletsStore = defineStore({
    id: 'outletsStore',
    state: (): { outlets: Outlet[], selectedOutlet: Outlet | null } => ({
        outlets: [],
        selectedOutlet: null
    }),
    actions: {
        async fetchGetOutlets(): Promise<Outlet[]> {
            let res = await getOutlets()
            this.outlets = await res.json()
            return this.outlets
        },
        async fetchGetOutlet(id: number): Promise<Outlet> {
            let res = await getOutlet(id)
            return await res.json()
        },
        async fetchAddOutlet(outlet: OutletFormData) {
            await addOutlet(outlet)
        },
        async fetchEditOutlet(id: number, outlet: OutletForEdit) {
            await updateOutlet(id, outlet)
        },
        async fetchDeleteOutlet(id: number) {
            await deleteOutlet(id)
        },
    }
});
