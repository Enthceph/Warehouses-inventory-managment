export interface Warehouse {
    id: number
    name: string
    location: string | null
    contactInfo: string | null
    createdAt: Date | null
}
export type UpdateWarehouseForm = Pick<
    Warehouse,
    'id' | 'name' | 'location' | 'contactInfo'
>

export type AddWarehouseForm = Pick<
    Warehouse,
    'name' | 'location' | 'contactInfo'
>
