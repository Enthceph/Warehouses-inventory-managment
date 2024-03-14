import { defineStore } from 'pinia'
import {
    addInventory,
    deleteInventory,
    getInventories,
    getInventory,
    updateInventory,
} from '@/api/inventory'
import { Inventory, InventoryFormData } from '@/js/types/inventory.types'

export const useInventoriesStore = defineStore({
    id: 'inventoriesStore',
    state: (): { inventories: Inventory[] } => ({
        inventories: [],
    }),
    actions: {
        async fetchGetInventories(): Promise<Inventory[]> {
            let res = await getInventories()
            this.inventories = await res
            return this.inventories
        },
        async fetchGetInventory(id: number): Promise<Inventory> {
            let res = await getInventory(id)
            return await res
        },
        async fetchAddInventory(inventory: InventoryFormData) {
            await addInventory(inventory)
        },
        async fetchUpdateInventory(id: number, inventory: InventoryFormData) {
            await updateInventory(id, inventory)
        },
        async fetchDeleteInventory(id: number) {
            await deleteInventory(id)
        },
    },
})
