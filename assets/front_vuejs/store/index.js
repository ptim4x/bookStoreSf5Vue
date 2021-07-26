import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    cartTotalQty: 0,
    cartItems: [{'productId': 1, 'qty': 2}]
  },
  mutations: {
    INCREASE_TOTAL_ITEMS(state, payload = 1) {
      state.cartTotalQty += Number(payload)
    }
  },
  actions: {
    incrementTotalItems(context, amount) {
      context.commit('INCREASE_TOTAL_ITEMS', amount)
    }
  },
  modules: {},
  getters: {},
});
