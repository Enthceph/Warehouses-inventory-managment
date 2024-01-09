import {defineStore} from 'pinia';
import {addWarehouse, deleteWarehouse, editWarehouse, getWarehouse, getWarehouses} from "@/api/warehouse";

export interface Warehouse {
    id: number;
    name: string;
    location: string | null;
    contact_info: string | null;
}

export const useWarehouseStore = defineStore({
    id: 'warehouseStore',
    state: (): { warehouses: Warehouse[] } => ({
        warehouses: []
    }),
    actions: {
        async fetchGetWarehouses() {
            let res = await getWarehouses()
            this.warehouses = await res.json()
        },
        async fetchGetWarehouse(id: number) {
            let res = await getWarehouse(id)
            console.log(res)
        },
        async fetchAddWarehouse(warehouse: Warehouse) {
            let res = await addWarehouse(warehouse)
            console.log(res)
        },
        async fetchEditWarehouse(id: number, warehouse: Warehouse) {
            let res = await editWarehouse(id, warehouse)
            console.log(res)
        },
        async fetchDeleteWarehouse(id: number) {
            let res = await deleteWarehouse(id)
            console.log(res)
        },
    },

});
