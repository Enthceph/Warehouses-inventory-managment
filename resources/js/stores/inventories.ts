import {defineStore} from 'pinia';
import {getInventories} from "@/api/inventory";


export interface Inventory {
    id: number;
    quantity: number;
    unit_price: number;
    total_value: number;
    product_id: number;
    warehouse_id: number;
    created_at: Date;
    updated_at: Date;
}

export const useInventoriesStore = defineStore({
    id: 'inventoriesStore',
    state: (): { inventories: Inventory[] } => ({
        inventories: [],
    }),
    actions: {
        async fetchGetInventories(): Promise<Inventory[]> {
            let res = await getInventories()
            this.inventories = await res.json()
            return this.inventories
        },
        // async fetchGetWarehouse(id: number): Promise<Warehouse> {
        //     let res = await getWarehouse(id)
        //     return await res.json()
        // },
        // async fetchAddWarehouse(warehouse: WarehouseWithoutId) {
        //     await addWarehouse(warehouse)
        // },
        // async fetchEditWarehouse(id: number, warehouse: Warehouse) {
        //     await editWarehouse(id, warehouse)
        // },
        // async fetchGetWarehouseInventory(id: number): Promise<Inventory[]> {
        //     let res = await getWarehouseInventory({id: id})
        //     return await res.json()
        // },
        // async fetchDeleteWarehouse(id: number) {
        //     await deleteWarehouse(id)
        // },
    },
});
