import {defineStore} from 'pinia';

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
    actions: {
        setUser(user: User) {
            this.first_name = user.first_name
            this.last_name = user.last_name
            this.email = user.email
            this.role = user.role
        },
        clearOutlet() {
            this.first_name = ''
            this.last_name = ''
            this.email = ''
            this.role = ''
        }
    },

});
