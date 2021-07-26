import Vue from 'vue'
import VueRouter from 'vue-router'
import Products from '../components/Products'
import Product from '../components/Product'

Vue.use(VueRouter)

const routes = [
  { path: '/', component: Products, name: 'products' },
  { path: '/product/:productId', component: Product, name: 'product' }
]

export default new VueRouter({
  mode: 'history',
  base: '/app/',
  routes
})

