<template>
  <b-row >
    <b-col v-if="withLabel" cols="6" class="text-end">
      <h4 >Quantité :</h4>
    </b-col>
    <b-col :cols="withLabel ? 2 : 6">
      <input v-model="item_qty" min="1" class="form-control input-qty>" type="number">
    </b-col>
    <b-col class="action">
      <b-button class="add-to-cart w-100" @click="addToCart(product, item_qty)">{{ btnTitle }}</b-button>
    </b-col>
  </b-row >
</template>

<script>
  export default {
    name: 'AddToCart',
    props: {
      product: {
        required: true
      },
      btnTitle: {
        default: 'Ajouter au panier'
      },
      withLabel: {
        default: true
      }
    },
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