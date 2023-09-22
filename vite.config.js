import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import AutoImport from 'unplugin-auto-import/vite'

export default defineConfig({
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
            dts: 'types/auto-imports.d.ts',
            vueTemplate: true,

            imports: ['vue', 'vue-router'],
            dirs: ['resourses/js/composables'],
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
