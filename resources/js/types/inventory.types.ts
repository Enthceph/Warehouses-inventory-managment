import { Product } from '@/js/types/product.types'
import { Warehouse } from '@/js/types/warehouse.types'

export interface Inventory {
    id: number
    quantity: number
    unitPrice: number
    totalValue: number
    productId: number
    warehouseId: number
    createdAt: string
    expiresAt: string | null
    product: Product
    warehouse: Warehouse
}

export type InventoryFormData = Pick<
    Inventory,
    'quantity' | 'unitPrice' | 'totalValue' | 'productId' | 'expiresAt'
> & {
    warehouseId: Inventory['warehouseId'] | null
}

export interface AnalyticsFilterOptions {
    products: String[]
    additionalInfo: String[]
    warehouses: String[]
    outlets: String[]
    unitPrice:
        | {
              min: number
              max: number
          }
        | undefined
    totalValue:
        | {
              min: number
              max: number
          }
        | undefined
    quantity:
        | {
              min: number
              max: number
          }
        | undefined
    createdAt:
        | {
              from: Date
              to: Date
          }
        | undefined
        | Date
}
export interface AnalyticsFilterModels {
    products: String[] | undefined
    warehouses: String[] | undefined
    outlets: String[] | undefined
    additionalInfo: String[] | undefined
    quantity:
        | {
              min: number
              max: number
          }
        | undefined
    createdAt:
        | {
              from: number
              to: number
          }
        | undefined
    expiresAt:
        | {
              from: number
              to: number
          }
        | undefined
    unitPrice:
        | {
              min: number
              max: number
          }
        | undefined
    totalValue:
        | {
              min: number
              max: number
          }
        | undefined
}
