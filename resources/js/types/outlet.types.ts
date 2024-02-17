import {Warehouse} from "@/js/types/warehouse.types";

export interface Outlet {
    id: number;
    company_id: number;
    warehouse_id: number;
    name: string;
    address: string | null;
    contact_info: string | null;
    created_at: string | null;
    updated_at: string | null;
    warehouse: Warehouse
}

export interface OutletFormData {
    name: Outlet['name']
    address: Outlet['address']
    contact_info: Outlet['contact_info']
    warehouse_id: Outlet['warehouse_id']
}

export interface OutletAddForm {
    name: Outlet['name']
    address: Outlet['address']
    contact_info: Outlet['contact_info']
    warehouse_name: string | null
}
