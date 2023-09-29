import {defineStore} from 'pinia';

interface Outlet {
    id: number;
    organisation_id: number;
    name: string;
    address: string | null;
    contact_info: string | null;
    created_at: string | null;
    updated_at: string | null;
}

export const useOutletStore = defineStore({
    id: 'outletStore',
    state: (): Outlet => ({
        id: 0,
        organisation_id: 0,
        name: '',
        address: null,
        created_at: null,
        updated_at: null,
        contact_info: null,
    }),
    actions: {
        setOutlet(outlet: Outlet) {
            this.id = outlet.id ?? this.id;
            this.organisation_id = outlet.organisation_id ?? this.organisation_id;
            this.name = outlet.name ?? this.name;
            this.address = outlet.address ?? this.address;
            this.contact_info = outlet.contact_info ?? this.contact_info;
            this.created_at = outlet.created_at ?? this.created_at;
            this.updated_at = outlet.updated_at ?? this.updated_at;
        },
        clearOutlet() {
            this.id = 0
            this.organisation_id = 0
            this.name = ''
            this.address = null
            this.contact_info = null
            this.created_at = null
            this.updated_at = null
        }
    },

});
