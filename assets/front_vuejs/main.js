import Vue from 'vue'
import vuetify from './plugins/vuetify'
import store from "./store"
import router from "./router";

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

window.axios = require('axios');

import Cart from './components/Cart';
import AddToCart from './components/AddToCart';

new Vue({
  store,
  router,
  vuetify,
  components: {
    'cart': Cart,
    'add-to-cart': AddToCart,
  },
}).$mount('#app')