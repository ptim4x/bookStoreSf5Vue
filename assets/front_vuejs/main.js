import Vue from 'vue'
import VueRouter from 'vue-router'
import vuetify from './plugins/vuetify'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import Products from './components/Products'
import Product from './components/Product'

window.axios = require('axios');

const routes = [
    { path: '/', component: Products, name: 'products' },
    { path: '/product/:productId', component: Product, name: 'product' }
]

const router = new VueRouter({
    mode: 'history',
    base: '/app/',
    routes
})

Vue.use(VueRouter)

new Vue({
    router,
    vuetify,
}).$mount('#app')