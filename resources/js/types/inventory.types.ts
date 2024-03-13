import { Product } from '@/js/types/product.types'
import { Warehouse } from '@/js/types/warehouse.types'

export interface Inventory {
    id: number
    quantity: number
    unit_price: number
    total_value: number
    product_id: number
    warehouse_id: number
    created_at: string
    updated_at: string
    deleted_at: null | string
    expires_at: string | null
    product: Product
    warehouse: Warehouse
}

export interface InventoryFormData {
    quantity: Inventory['quantity']
    unit_price: Inventory['unit_price']
    total_value: Inventory['total_value']
    product_id: Inventory['product_id']
    warehouse_id: Inventory['warehouse_id'] | null
    expires_at: Inventory['expires_at']
}

export interface AnalyticsFilterOptions {
    products: String[]
    additional_info: String[]
    warehouses: String[]
    outlets: String[]
    unit_price:
        | {
              min: number
              max: number
          }
        | undefined
    total_value:
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
    created_at:
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
    additional_info: String[] | undefined
    quantity:
        | {
              min: number
              max: number
          }
        | undefined
    created_at:
        | {
              from: number
              to: number
          }
        | undefined
    expires_at:
        | {
              from: number
              to: number
          }
        | undefined
    unit_price:
        | {
              min: number
              max: number
          }
        | undefined
    total_value:
        | {
              min: number
              max: number
          }
        | undefined
}
