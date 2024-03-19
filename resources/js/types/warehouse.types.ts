export interface Warehouse {
    id: number
    name: string
    location: string | null
    contact_info: string | null
    created_at: Date | null
}
export type UpdateWarehouseForm = Pick<
    Warehouse,
    'id' | 'name' | 'location' | 'contact_info'
>

export type AddWarehouseForm = Pick<
    Warehouse,
    'name' | 'location' | 'contact_info'
>
