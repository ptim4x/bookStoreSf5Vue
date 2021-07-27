<template>
  <b-row >
    <b-col>
      <b-row>
        <b-col class="text-right">
          <h4 >Quantité :</h4>
        </b-col>
        <b-col cols="4">
          <input v-model="item_qty" min="1" class="form-control input-qty>" type="number">
        </b-col>
      </b-row >
    </b-col>
    <b-col class="action">
      <b-button class="add-to-cart float-right" @click="addToCart(product, item_qty)">ajouter au panier</b-button>
    </b-col>
  </b-row >
</template>

<script>
  export default {
    name: 'AddToCart',
    props: ['product'],
    data: () => ({
      item_qty: 1
    }),
    methods: {
      addToCart(product, qty = 1) {
        let itemToAdd = {'product': product, 'qty': qty };
        this.$store.dispatch('addItem', itemToAdd);
      }
    }
  }
</script>

<style scoped>
  .add-to-cart {
    background: #ff9f1a;
    padding: 1.2em 1.5em;
    border: none;
    text-transform: UPPERCASE;
    font-weight: bold;
    color: #fff;
    -webkit-transition: background .3s ease;
            transition: background .3s ease;
  }
  
  .add-to-cart:hover {
      background: #b36800;
      color: #fff; 
  }
</style>