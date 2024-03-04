import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import auth from './middleware/auth.js'
import { Context } from '@/js/types/router.types'
import middlewarePipeline from '@/js/router/middleware/middlewarePipeline'

import CenterLayout from '../layouts/CenterLayout.vue'
import NoLayout from '../layouts/NoLayout.vue'
import DefaultLayout from '../layouts/DefaultLayout.vue'
import { Component } from 'vue'

declare module 'vue-router' {
    interface RouteMeta {
        layout?: Component
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
        name: 'Login',
        component: () => import('../pages/Login.vue'),
        meta: {
            layout: CenterLayout,
        },
    },
    {
        path: '/registration',
        name: 'Registration',
        component: () => import('../pages/Registration.vue'),
        meta: {
            layout: CenterLayout,
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
            layout: NoLayout,
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
        path: '/outlets',
        children: [
            {
                path: '',
                name: 'Outlets',
                component: () => import('../pages/Outlets/Outlets.vue'),
                meta: {
                    middleware: [auth],
                },
            },
            {
                path: ':outlet',
                name: 'Outlet',
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
                name: 'Employees',
                component: () => import('../pages/Employees/Employees.vue'),
                meta: {
                    middleware: [auth],
                },
            },
            {
                path: ':Employee',
                name: 'Employee',
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
        name: 'Analytics',
        meta: {
            middleware: [auth],
        },
    },
    {
        path: '/dashboard',
        component: () => import('../pages/Dashboard.vue'),
        name: 'Dashboard',
        meta: {
            middleware: [auth],
        },
    },
    {
        path: '/products',
        component: () => import('../pages/Products.vue'),
        name: 'Products',
        meta: {
            middleware: [auth],
        },
    },
    {
        path: '/productCategories',
        component: () => import('../pages/ProductCategories.vue'),
        name: 'Product categories',
        meta: {
            middleware: [auth],
        },
    },
] as const

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }

    const middleware = to.meta.middleware
    const context: Context = { to, from, next }

    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1),
    })
})

router.afterEach((to) => {
    document.title = (to.name as string) || 'Inventory management'
})

export default router
