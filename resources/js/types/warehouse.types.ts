export interface Warehouse {
    id: number;
    name: string;
    location: string | null;
    contact_info: string | null;
    created_at: Date | null
}

export type WarehouseWithoutId = Omit<Warehouse, 'id'>;
