import {defineStore} from 'pinia';
import {useFetching} from "@/js/composables/useFetching";
import {getUser, user} from "@/api/user";
import {User} from "@/js/types/user.types";

// TODO этот store надо удалить, а вместо него сдеалть employee store
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
        async fetchUserById(id: Number) {
            const res = await getUser(id)
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
