import { Warehouse } from '@/js/types/warehouse.types'

export interface Outlet {
    id: number
    companyId: number
    warehouseId: number
    name: string
    address: string | null
    contactInfo: string | null
    createdAt: string | null
    warehouse: Warehouse
}

export interface OutletFormData
    extends Pick<Outlet, 'name' | 'address' | 'contactInfo' | 'warehouseId'> {}

export interface OutletAddForm
    extends Pick<Outlet, 'name' | 'address' | 'contactInfo'> {
    warehouseName: string | null
}
