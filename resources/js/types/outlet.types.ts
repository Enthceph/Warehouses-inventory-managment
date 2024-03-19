import { Warehouse } from '@/js/types/warehouse.types'

export interface Outlet {
    id: number
    company_id: number
    warehouse_id: number
    name: string
    address: string | null
    contact_info: string | null
    created_at: string | null
    updated_at: string | null
    warehouse: Warehouse
}

export interface OutletFormData
    extends Pick<
        Outlet,
        'name' | 'address' | 'contact_info' | 'warehouse_id'
    > {}

export interface OutletAddForm extends Omit<Outlet, 'warehouse_id'> {
    warehouse_name: string | null
}
