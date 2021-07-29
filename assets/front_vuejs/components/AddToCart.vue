<template>
  <b-row align-v="center" no-gutters>
    <b-col v-if="withLabel" cols="5" class="text-end text-uppercase font-weight-bold mr-3" style="font-size: 1.5rem;">
      Quantité :
    </b-col>
    <b-col :cols="withLabel ? 2 : 6" class="mr-3">
      <b-form-input v-model="item_qty" :size="size" min="1" class="form-control input-qty>" type="number"></b-form-input>
    </b-col>
    <b-col>
      <b-button class="add-to-cart w-100" :size="size" @click="addToCart(product, item_qty)">{{ btnTitle }}</b-button>
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
      },
      size: {
        default: 'lg'
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
    font-weight: bold;
    color: #fff;
    border: none; 
  }

  .add-to-cart:hover {
      background: #b36800;
  }
</style>