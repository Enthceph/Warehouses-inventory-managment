import {createApp} from 'vue'

import router from './router'

import {createPinia} from 'pinia'
import {Notify, Quasar} from 'quasar'
import '@quasar/extras/material-icons/material-icons.css'
import 'quasar/src/css/index.sass'

import VueApexCharts from 'vue3-apexcharts'

import '../css/_variables.css'
import '../css/fonts.css'
import '../css/app.css'

import Index from './pages/Index.vue'

const pinia = createPinia()

const app = createApp(Index)

Notify.registerType('success', {
    position: "top-right",
    color: "positive",
    icon: 'check_circle'
})

app.use(Quasar, {
    plugins: {
        Notify
    },
})
    .use(VueApexCharts)
    .use(pinia)
    .use(router)

router.isReady().then(() => {
    app.mount('#app')
})
