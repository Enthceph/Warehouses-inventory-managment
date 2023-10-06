import {createRouter, createWebHistory, RouteRecordRaw} from 'vue-router'
import auth from './middleware/auth.js'
import middlewarePipeline from './middleware/middlewarePipeline.js'
import {Context} from '../types/router'

declare module 'vue-router' {
    interface RouteMeta {
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
        component: () => import('../pages/Login.vue'),
        meta: {
            layout: 'NoLayout',
        },
    },

    {
        path: '/registration',
        name: 'Registration',
        component: () => import('../pages/Registration.vue'),
        meta: {
            layout: 'NoLayout',
        },
    },

    {
        path: '/settings',
        name: 'Settings',
        component: () => import('../pages/Settings.vue'),
        meta: {
            middleware: [auth],
            description: 'Настройки',
            icon: 'settings',
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
        component: () => import('../pages/Organisation.vue'),
        meta: {
            middleware: [auth],
            description: 'Organisation',
            icon: 'outlets',
        },
    },

    {
        path: '/Outlet/:outlet',
        name: 'Outlet',
        component: () => import('../pages/Outlet/Outlet.vue'),
        meta: {
            middleware: [auth],
            description: 'Outlet Detail',
            icon: 'outlet',
        },
        children: [
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
                path: 'reports',
                name: 'OutletReports',
                component: () => import('../pages/Outlet/OutletReports.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Outlet Reports',
                    icon: 'reports',
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
                path: 'settings',
                name: 'OutletSettings',
                component: () => import('../pages/Outlet/OutletSettings.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Outlet Settings',
                    icon: 'settings',
                },
            },
        ],
    },
    {
        path: '/warehouse/:id',
        name: 'Warehouse',
        component: () => import('../pages/Warehouse/Warehouse.vue'),
        meta: {
            middleware: [auth],
            description: 'Warehouse Detail',
            icon: 'warehouse-detail',
        },
        children: [
            {
                path: 'overview',
                name: 'WarehouseOverview',
                component: () => import('../pages/Warehouse/WarehouseOverview.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Warehouse Overview',
                    icon: 'overview',
                },
            },
            {
                path: 'transactions',
                name: 'WarehouseTransactions',
                component: () => import('../pages/Warehouse/WarehouseTransactions.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Warehouse Transactions',
                    icon: 'transactions',
                },
            },
            {
                path: 'reports',
                name: 'WarehouseReports',
                component: () => import('../pages/Warehouse/WarehouseReports.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Warehouse Reports',
                    icon: 'reports',
                },
            },
            {
                path: 'settings',
                name: 'WarehouseSettings',
                component: () => import('../pages/Warehouse/WarehouseSettings.vue'),
                meta: {
                    middleware: [auth],
                    description: 'Warehouse Settings',
                    icon: 'settings',
                },
            },
        ]
    }
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
