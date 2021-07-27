<template>
  <div>
    <v-btn icon id="cart-btn" @click="$bvModal.show('cart-details')">
      <v-badge
        color="green"
        :content="cartTotalQty"
        v-if="cartTotalQty > 0"
      >
        <v-icon>
          mdi-cart
        </v-icon>
      </v-badge>
      <v-icon v-else>
        mdi-cart
      </v-icon>
    </v-btn>
    <b-modal id="cart-details" title="Votre panier" size="lg" hide-footer>
      <div>

        <b-table v-if="cartTotalQty > 0" id="cart-list" striped :items="cartItems" :fields="columns" primary-key="id" foot-clone>
          <template #cell(title)="data">
            {{ data.item.product.title }}
          </template>
          <template #cell(price)="data">
            {{ data.item.product.price }} €
          </template>
          <template #cell(amount)="data">
            {{ (data.item.qty * data.item.product.price).toFixed(2) }} €
          </template>
          <template #foot(amount)>
            <span class="text-danger">{{cartTotalAmount}} €</span>
          </template>
          <template #foot(price)>Montant total</template>
          <template #foot()>&nbsp;</template>
        </b-table>
        <div v-else class="text-center">
            Le panier est vide.
        </div>
      </div>

      <b-row>
        <b-col>
          <b-button v-if="cartTotalQty > 0" block @click="cartErase">Vider le panier</b-button>
        </b-col>
        <b-col class="text-end">
          <b-button @click="$bvModal.hide('cart-details')">Fermer</b-button>
        </b-col>
      </b-row >
      
    </b-modal>
  </div>
</template>

<script>
  import { mapState } from 'vuex'

  export default {
    name: 'Cart',
    data: () => ({
      columns: [
        { key: 'title', label: 'Titre'},
        { key: 'qty', label: 'Quantité', tdClass: 'text-end', thClass: 'text-end' },
        { key: 'price', label: 'Prix Unitaire', tdClass: 'text-end', thClass: 'text-end' },
        { key: 'amount', label: 'Montant', tdClass: 'text-end', thClass: 'text-end' },
      ]
    }),
    methods: {
      cartErase() {
        this.$store.dispatch('cartErase');
      }
    },
    computed: {
        ...mapState(['cartItems', 'cartTotalQty', 'cartTotalAmount'])
    }
  }
</script>

<style scoped>
  #cart-btn {
    margin: 5px 5px 0 0;
  }
</style>