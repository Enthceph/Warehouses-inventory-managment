import {createRouter, createWebHistory, RouteRecordRaw} from 'vue-router'
import auth from './middleware/auth.js'
import {Context} from "@/js/types/router";
import middlewarePipeline from "@/js/router/middleware/middlewarePipeline";

declare module 'vue-router' {
    interface RouteMeta {
        layout?: string
        middleware?: Function[]
    }
}

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        name: 'Home',
        redirect: {
            path: '/company',
        },
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../pages/Login.vue'),
        meta: {
            layout: 'CenterLayout',
        },
    },
    {
        path: '/registration',
        name: 'Registration',
        component: () => import('../pages/Registration.vue'),
        meta: {
            layout: 'CenterLayout',
        },
    },
    {
        path: '/settings',
        name: 'Settings',
        component: () => import('../pages/Settings.vue'),
        meta: {
            middleware: [auth],
            description: 'Настройки',
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
        path: '/company',
        name: 'Company',
        component: () => import('../pages/Company.vue'),
        meta: {
            middleware: [auth],
        },
    },
    {
        path: '/warehouses',
        children: [
            {
                path: '',
                name: 'Warehouses',
                component: () => import('../pages/Warehouses/Warehouses.vue'),
                meta: {
                    middleware: [auth],
                },
            },
            {
                path: ':warehouse',
                name: 'Warehouse',
                component: () => import('../pages/Warehouses/Warehouse.vue'),
                meta: {
                    middleware: [auth],
                },
            },
        ],
    },
    {
        path: '/inventories',
        children: [
            {
                path: '',
                name: 'Inventories',
                component: () => import('../pages/Inventories/Inventories.vue'),
                meta: {
                    middleware: [auth],
                },
            },
            {
                path: ':inventory',
                name: 'Inventory',
                component: () => import('../pages/Inventories/Inventory.vue'),
                meta: {
                    middleware: [auth],
                },
            },
        ],
    },

    {
        path: '/Outlet/:outlet',
        name: 'Outlet',
        component: () => import('../pages/Outlet/Outlet.vue'),
        meta: {
            middleware: [auth],
            description: 'Outlet Detail',
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

router.afterEach((to) => {
    document.title = (to.name as string) || 'Inventory managment'
})

export default router
