import { defineStore } from 'pinia'
import {
    AddWarehouseForm,
    UpdateWarehouseForm,
    Warehouse,
} from '@/js/types/warehouse.types'
import {
    addWarehouse,
    deleteWarehouse,
    getWarehouse,
    getWarehouses,
    updateWarehouse,
} from '@/js/api/warehouse'

export const useWarehousesStore = defineStore({
    id: 'warehousesStore',
    state: (): {
        warehouses: Warehouse[]
        selectedWarehouse: Warehouse | null
    } => ({
        warehouses: [],
        selectedWarehouse: null,
    }),
    actions: {
        async fetchGetWarehouses(): Promise<Warehouse[]> {
            let res = await getWarehouses()
            this.warehouses = await res
            return this.warehouses
        },
        async fetchGetWarehouse(id: number): Promise<Warehouse> {
            let res = await getWarehouse(id)
            return await res
        },
        async fetchAddWarehouse(warehouse: AddWarehouseForm) {
            await addWarehouse(warehouse)
            await this.fetchGetWarehouses()
        },
        async fetchUpdateWarehouse(warehouse: UpdateWarehouseForm) {
            await updateWarehouse(warehouse)
            await this.fetchGetWarehouses()
        },

        async fetchDeleteWarehouse(id: number) {
            await deleteWarehouse(id)
            await this.fetchGetWarehouses()
        },
    },
})
