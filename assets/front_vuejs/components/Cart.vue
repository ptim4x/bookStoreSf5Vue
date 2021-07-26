<template>
  <v-btn icon id="cart-btn">
        <v-icon v-if="cartTotalQty==0">
          mdi-cart
        </v-icon>
        <v-badge
          color="green"
          :content="cartTotalQty"
          v-if="cartTotalQty>0"
        >
          <v-icon>
            mdi-cart
          </v-icon>
        </v-badge>
  </v-btn>
</template>

<script>
  import { mapState } from 'vuex'

  export default {
    name: 'Cart',
    props: {},
    data: () => ({
      totalCartItem: 6
    }),
    methods: {
    },
    computed: {
        ...mapState(['cartTotalQty'])
    }
  }
</script>

<style scoped>
  #cart-btn {
    margin: 5px 5px 0 0;
  }
</style>