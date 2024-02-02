import {createRouter, createWebHistory, RouteRecordRaw} from 'vue-router'
import auth from './middleware/auth.js'
import {Context} from "@/js/types/router.types";
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
        name: 'Index',
        redirect: {
            path: '/dashboard',
        },
    },
    {
        path: '/login',
        name: 'Логін',
        component: () => import('../pages/Login.vue'),
        meta: {
            layout: 'CenterLayout',
        },
    },
    {
        path: '/registration',
        name: 'Реєстрація',
        component: () => import('../pages/Registration.vue'),
        meta: {
            layout: 'CenterLayout',
        },
    },
    {
        path: '/settings',
        name: 'Налаштування',
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
        path: '/warehouses',
        children: [
            {
                path: '',
                name: 'Склади',
                component: () => import('../pages/Warehouses/Warehouses.vue'),
                meta: {
                    middleware: [auth],
                },
            },
            {
                path: ':warehouse',
                name: 'Склад',
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
                name: 'Товарні запаси',
                component: () => import('../pages/Inventories/Inventories.vue'),
                meta: {
                    middleware: [auth],
                },
            },
            {
                path: ':inventory',
                name: 'Інвентар',
                component: () => import('../pages/Inventories/Inventory.vue'),
                meta: {
                    middleware: [auth],
                },
            },
        ],
    },
    {
        path: '/outlets',
        children: [
            {
                path: '',
                name: 'Точки',
                component: () => import('../pages/Outlets/Outlets.vue'),
                meta: {
                    middleware: [auth],
                },
            },
            {
                path: ':outlet',
                name: 'Точка',
                component: () => import('../pages/Outlets/Outlet.vue'),
                meta: {
                    middleware: [auth],
                },
            },
        ],
    },

    {
        path: '/employees',
        children: [
            {
                path: '',
                name: 'Співробітники',
                component: () => import('../pages/Employees/Employees.vue'),
                meta: {
                    middleware: [auth],
                },
            },
            {
                path: ':Employee',
                name: 'Співробітник',
                component: () => import('../pages/Employees/Employee.vue'),
                meta: {
                    middleware: [auth],
                },
            },
        ],
    },

    {
        path: '/analytics',
        component: () => import('../pages/Analytics.vue'),
        name: 'Аналітика',
        meta: {
            middleware: [auth],
        },
    },
    {
        path: '/Dashboard',
        component: () => import('../pages/Dashboard.vue'),
        name: 'Дашбоард',
        meta: {
            middleware: [auth],
        },
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

router.afterEach((to) => {
    document.title = (to.name as string) || 'Inventory management'
})

export default router
