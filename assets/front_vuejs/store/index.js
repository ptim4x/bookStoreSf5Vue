import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersist from 'vuex-persist'

Vue.use(Vuex)

const vuexPersist = new VuexPersist({
  key: 'bookstore-app-cart',
  storage: window.sessionStorage
})

export default new Vuex.Store({
  state: {
    cartItems: [],
    cartTotalQty: 0,
    cartTotalAmount: 0,
  },
  mutations: {
    /* Add an item to the cart
    format for item = {'product': product, 'qty': qty}; */
    CART_ADD_ITEM(state, itemToAdd) {
      var itemInCart = state.cartItems.filter(item => item.product.id===itemToAdd.product.id);
      var isItemInCart = itemInCart.length > 0;
      if (isItemInCart === false) {
        state.cartItems.push(Vue.util.extend({}, itemToAdd));
      } else {
        itemInCart[0].qty = Number(itemInCart[0].qty) + Number(itemToAdd.qty);
      }
    },
    /* Erase Cart content */
    CART_ERASE(state) {
        state.cartItems = [];
    },
    /* Update Cart total quantity and amount */
    UPDATE_TOTAL(state) {
      var totalQty = 0;
      var totalAmount = 0;
      state.cartItems.forEach(item => {
        totalAmount = Number(totalAmount) + Number(item.product.price) * Number(item.qty);
        totalQty = Number(totalQty) + Number(item.qty);
      });
      state.cartTotalQty = totalQty;
      state.cartTotalAmount = totalAmount.toFixed(2);
    },
  },
  actions: {
    addItem(context, item) {
      context.commit('CART_ADD_ITEM', item);
      context.commit('UPDATE_TOTAL');
    },
    cartErase(context) {
      context.commit('CART_ERASE');
      context.commit('UPDATE_TOTAL');
    }
  },
  modules: {},
  getters: {},
  plugins: [vuexPersist.plugin]
});
