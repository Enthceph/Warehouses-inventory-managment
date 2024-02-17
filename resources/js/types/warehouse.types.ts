export interface Warehouse {
    id: number;
    name: string;
    location: string | null;
    contact_info: string | null;
    created_at: Date | null
}

export interface EditWarehouseForm {
    id: Warehouse['id']
    name: Warehouse['name']
    location: Warehouse['location']
    contact_info: Warehouse['contact_info']
}

export interface AddWarehouseForm {
    name: Warehouse['name']
    location: Warehouse['location']
    contact_info: Warehouse['contact_info']
}
