import { defineStore } from 'pinia'
import {
    addInventory,
    deleteInventory,
    getInventories,
    getInventory,
    updateInventory,
} from '@/js/api/inventory'
import { Inventory, InventoryFormData } from '@/js/types/inventory.types'
import { Pagination } from '../types/pagination.types'

export const useInventoriesStore = defineStore({
    id: 'inventoriesStore',
    state: (): { inventories: Inventory[] } => ({
        inventories: [],
    }),
    actions: {
        async fetchGetInventories(params?: {
            [key: string]: string | number
        }): Promise<Pagination<Inventory>> {
            let res = await getInventories(params)
            this.inventories = res.data
            return res
        },
        async fetchGetInventory(id: number): Promise<Inventory> {
            let res = await getInventory(id)
            return res
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
