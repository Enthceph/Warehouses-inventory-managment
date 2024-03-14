import { defineStore } from 'pinia'
import { getRoles } from '@/js/api/roles'
import { Role } from '@/js/types/role.types'

export const useRolesStore = defineStore({
    id: 'rolesStore',
    state: (): { roles: Role[] } => ({
        roles: [],
    }),
    actions: {
        async fetchGetRoles(): Promise<Role[]> {
            let res = await getRoles()
            this.roles = await res
            return this.roles
        },
    },
})
