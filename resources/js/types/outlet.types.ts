export interface Outlet {
    id: number;
    company_id: number;
    warehouse_id: number;
    name: string;
    address: string | null;
    contact_info: string | null;
    created_at: string | null;
    updated_at: string | null;
}

export interface OutletFormData {
    name: string
    address?: string
    contact_info?: string
    outlet_name?: string
}

export type OutletForEdit = Omit<Outlet, 'created_at' | 'updated_at' | 'company_id'>
