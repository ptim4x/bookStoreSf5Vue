/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

// Vue settings
import Vue from 'vue'
import axios from "axios";
import VueRouter from 'vue-router'
import vuetify from './plugins/vuetify'

import Home from './components/Home'


const routes = [
    { path: '/', component: Home, name: 'home' }
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
    data () {
        return {
          info: null,
          loading: true,
          errored: false
        }
      },
    mounted(){
        axios
        .get('/api/products')
        .then(response => (this.info = response))
    }
}).$mount('#app')