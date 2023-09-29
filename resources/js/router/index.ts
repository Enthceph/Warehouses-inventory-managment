import {createRouter, createWebHistory, RouteRecordRaw} from 'vue-router'
import auth from './middleware/auth.js'
import middlewarePipeline from './middleware/middlewarePipeline.js'
import {Context} from '../types/router'

declare module 'vue-router' {
    interface RouteMeta {
        addToNavbar?: boolean
        layout?: string
        middleware?: Function[]
        description?: string
        icon?: string
    }
}

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        name: 'Home',
        redirect: {
            path: '/organisation',
        },
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../pages/LoginPage.vue'),
        meta: {
            layout: 'NoLayout',
        },
    },

    {
        path: '/registration',
        name: 'Registration',
        component: () => import('../pages/RegistrationPage.vue'),
        meta: {
            layout: 'NoLayout',
        },
    },

    {
        path: '/settings',
        name: 'Settings',
        component: () => import('../pages/SettingsPage.vue'),
        meta: {
            middleware: [auth],
            description: 'Настройки',
            icon: 'settings',
            addToNavbar: true,
        },
    },

    {
        path: '/dev',
        name: 'Dev',
        component: () => import('../pages/DevPage.vue'),
        meta: {
            description: "Dev's page",
            icon: 'developer_mode',
            addToNavbar: true,
        },
    },

    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import('../pages/NotFound.vue'),
        meta: {
            layout: 'NoLayout',
        },
    },

    {
        path: '/organisation',
        name: 'Organisation',
        component: () => import('../pages/OrganisationPage.vue'),
        meta: {
            middleware: [auth],
            description: 'Organisation',
            icon: 'outlets',
        },
    },

    {
        path: '/Outlets/reports',
        name: 'OutletReports',
        component: () => import('../pages/OutletsPageReports.vue'),
        meta: {
            middleware: [auth],
            description: 'Outlets Reports',
            icon: 'reports',
        },
    },

    {
        path: '/Outlets/:outlet',
        name: 'OutletDetail',
        component: () => import('../pages/Outlet/OutletDetail.vue'),
        meta: {
            middleware: [auth],
            description: 'Outlet Detail',
            icon: 'outlet-detail',
        },
        children: [
            {
                path: 'transactions',
                name: 'OutletTransactions',
                component: () =>
                    import('../pages/Outlet/OutletTransactions.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Outlet Transactions',
                    icon: 'transactions',
                },
            },
            {
                path: 'suppliers',
                name: 'OutletSuppliers',
                component: () => import('../pages/Outlet/OutletSuppliers.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Outlet Suppliers',
                    icon: 'suppliers',
                },
            },
            {
                path: 'employees',
                name: 'OutletEmployees',
                component: () => import('../pages/Outlet/OutletEmployees.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Outlet Employees',
                    icon: 'customers',
                },
            },
            {
                path: 'overview',
                name: 'OutletOverview',
                component: () => import('../pages/Outlet/OutletOverview.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Outlet Overview',
                    icon: 'taxes',
                },
            },
            {
                path: 'reports',
                name: 'OutletReports',
                component: () => import('../pages/Outlet/OutletReports.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Outlet Reports',
                    icon: 'reports',
                },
            },
        ],
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }

    const middleware = to.meta.middleware
    const context: Context = {to, from, next}

    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1),
    })
})

router.afterEach((to, from, next) => {
    document.title = (to.name as string) || 'Bookkeeping'
})

export default router
