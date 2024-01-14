export interface Warehouse {
    id: number;
    name: string;
    location: string | null;
    contact_info: string | null;
}

export type WarehouseWithoutId = Omit<Warehouse, 'id'>;
