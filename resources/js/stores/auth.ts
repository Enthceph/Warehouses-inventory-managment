import {defineStore} from 'pinia';
import {getAuthenticatedUser} from "@/api/auth";
import {Auth} from "@/js/types/auth.types";

export const useAuthStore = defineStore({
    id: 'authStore',
    state: (): Auth => ({
        id: 0,
        full_name: '',
        email: '',
        role: '',
        company: '',
        created_at: null
    }),
    getters: {},
    actions: {
        async getUser(): Promise<(auth: Auth) => void> {
            const user = await getAuthenticatedUser().json()
            // @ts-ignore
            this.setUser(user)
            return this.setUser
        },

        setUser(auth: Auth) {
            this.id = auth.id
            this.full_name = auth.full_name
            this.email = auth.email
            this.role = auth.role
            this.company = auth.company
            this.created_at = auth.created_at
        },
        clearUser() {
            this.id = 0
            this.full_name = ''
            this.email = ''
            this.role = ''
            this.company = ''
            this.created_at = null
        }
    },
});
