export interface Inventory {
    id: number;
    quantity: number;
    unit_price: number;
    total_value: number;
    product_id: number;
    warehouse_id: number;
    created_at: Date;
    updated_at: Date;
}
