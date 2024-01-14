import {defineStore} from 'pinia';
import {useFetching} from "@/js/composables/useFetching";
import {user} from "@/api/user";
import {User} from "@/js/types/user.types";


export const useUserStore = defineStore({
    id: 'userStore',
    state: (): User => ({
        full_name: '',
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
            this.full_name = user.full_name
            this.email = user.email
            this.role = user.role
        },
        clearUser() {
            this.full_name = ''
            this.email = ''
            this.role = ''
        }
    },
});
