import {defineStore} from 'pinia';
import {
    addWarehouse,
    deleteWarehouse,
    editWarehouse,
    getWarehouse,
    getWarehouseInventory,
    getWarehouses
} from "@/api/warehouse";

export interface Warehouse {
    id: number;
    name: string;
    location: string | null;
    contact_info: string | null;
}

// TODO перенести этот интерфейс в подходящее место


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

export type WarehouseWithoutId = Omit<Warehouse, 'id'>;

export const useWarehouseStore = defineStore({
    id: 'warehouseStore',
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
            await editWarehouse(id, warehouse)
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
