import {defineConfig} from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import AutoImport from 'unplugin-auto-import/vite'

export default defineConfig({
    server: {
        host:'0.0.0.0',
        port:3000,
        open:false,
    },

    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),

        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                    img: './resource',
                },
            },
        }),
        AutoImport({
            dts: 'resources/js/types/auto-imports.d.ts',
            vueTemplate: true,

            imports: ['vue', 'vue-router'],
            dirs: ['resources/js/composables'],
        }),
    ],

    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': '/resources',
        },
        extensions: ['.js', '.ts', '.json', '.vue'],
    },
})
