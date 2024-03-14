import { checkAuth } from '@/js/api/auth'
import { NavigationGuardNext, RouteLocationNormalized } from 'vue-router'

type Context = {
    to: RouteLocationNormalized
    from: RouteLocationNormalized
    next: NavigationGuardNext
}

const auth = async ({ next }: Context) => {
    if (!localStorage.getItem('access_token')) {
        return next({ path: '/login' })
    }

    try {
        await checkAuth()
    } catch (error) {
        //@ts-ignore
        if (error.response.status === 401) {
            console.log(
                '%cauth failed, redirecting to login page',
                'color: Crimson'
            )
            return next({ path: '/login' })
        }
    }

    return next()
}

export default auth
