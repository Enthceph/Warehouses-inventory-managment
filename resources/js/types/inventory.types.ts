export interface Inventory {
    id: number;
    quantity: number;
    unit_price: string;
    total_value: string;
    product_id: number;
    warehouse_id: number;
    created_at: string;
    updated_at: string;
    deleted_at: null | string;
    expires_at: string;
    product: Product;
    warehouse: Warehouse;
}

type Category = {
    id: number;
    name: string;
    company_id: number;
    created_at: string;
    updated_at: string;
    deleted_at: null | string;
};

type Product = {
    id: number;
    name: string;
    company_id: number;
    created_at: string;
    updated_at: string;
    deleted_at: null | string;
    category_id: number;
    additional_info: null | string;
    category: Category;
};

type Warehouse = {
    id: number;
    name: string;
    location: string;
    contact_info: null | string;
    company_id: number;
    created_at: string;
    updated_at: string;
    deleted_at: null | string;
};
