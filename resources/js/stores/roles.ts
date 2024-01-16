import {defineStore} from 'pinia';
import {getRoles} from "@/api/roles";

interface Role {
    id: number,
    name: string
}

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
