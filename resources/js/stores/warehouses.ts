import {defineStore} from 'pinia';
import {Warehouse, WarehouseWithoutId} from "@/js/types/warehouse.types";
import {
    addWarehouse,
    deleteWarehouse,
    getWarehouse,
    getWarehouseInventory,
    getWarehouses,
    updateWarehouse
} from "@/api/warehouse";
import {Inventory} from "@/js/types/inventory.types";


export const useWarehousesStore = defineStore({
    id: 'warehousesStore',
    state: (): { warehouses: Warehouse[], selectedWarehouse: Warehouse | null } => ({
        warehouses: [],
        selectedWarehouse: null
    }),
    actions: {
        async fetchGetWarehouses(): Promise<Warehouse[]> {
            let res = await getWarehouses()
            this.warehouses = await res.json()
            return this.warehouses
        },
        async fetchGetWarehouse(id: number): Promise<Warehouse> {
            let res = await getWarehouse(id)
            return await res.json()
        },
        async fetchAddWarehouse(warehouse: WarehouseWithoutId) {
            await addWarehouse(warehouse)
        },
        async fetchEditWarehouse(id: number, warehouse: Warehouse) {
            await updateWarehouse(id, warehouse)
        },
        async fetchGetWarehouseInventory(id: number): Promise<Inventory[]> {
            let res = await getWarehouseInventory({id: id})
            return await res.json()
        },
        async fetchDeleteWarehouse(id: number) {
            await deleteWarehouse(id)
        },
    },
});
