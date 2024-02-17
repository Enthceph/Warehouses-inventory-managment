import {defineStore} from 'pinia';
import {getRoles} from "@/api/roles";
import {Role} from "@/js/types/role.types";

export const useRolesStore = defineStore({
    id: 'rolesStore',
    state: (): { roles: Role[] } => ({
        roles: [],
    }),
    actions: {
        async fetchGetRoles(): Promise<Role[]> {
            let res = await getRoles()
            this.roles = await res.json()
            return this.roles
        },
    }
});
