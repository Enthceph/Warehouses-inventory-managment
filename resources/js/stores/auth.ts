import { defineStore } from 'pinia'
import { getAuthUser } from '@/js/api/auth'
import { AuthUser } from '@/js/types/auth.types'

export const useAuthStore = defineStore({
    id: 'authStore',
    state: (): AuthUser => ({
        id: 0,
        fullName: '',
        email: '',
        role: '',
        company: '',
        created_at: null,
    }),
    getters: {},
    actions: {
        async getUser() {
            const user = await getAuthUser()
            this.setUser(user)
            return this.setUser
        },

        setUser(auth: AuthUser) {
            this.id = auth.id
            this.fullName = auth.fullName
            this.email = auth.email
            this.role = auth.role
            this.company = auth.company
            this.created_at = auth.created_at
        },

        clearUser() {
            this.id = 0
            this.fullName = ''
            this.email = ''
            this.role = ''
            this.company = ''
            this.created_at = null
        },
    },
})
