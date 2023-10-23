import {defineStore} from 'pinia';
import {useFetching} from "@/js/composables/useFetching";
import {user} from "@/api/user";

interface User {
    first_name: string
    last_name: string
    email: string
    role: string
}

export const useUserStore = defineStore({
    id: 'userStore',
    state: (): User => ({
        first_name: '',
        last_name: '',
        email: '',
        role: '',
    }),
    getters: {},
    actions: {
        async fetchUser() {
            const {fetch: fetchUser} = useFetching(user)
            const res = await fetchUser()
            this.setUser(res)
        },
        setUser(user: User) {
            this.first_name = user.first_name
            this.last_name = user.last_name
            this.email = user.email
            this.role = user.role
        },
        clearUser() {
            this.first_name = ''
            this.last_name = ''
            this.email = ''
            this.role = ''
        }
    },

});
