import {defineStore} from 'pinia';
import {getInventories} from "@/api/inventory";
import {Inventory} from "@/js/types/inventory.types";

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
