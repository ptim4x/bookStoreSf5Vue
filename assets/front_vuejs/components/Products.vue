<template>
  <div>
    <b-table id="product-list" striped hover dark :items="products" :fields="columns" primary-key="id" @row-clicked="onRowClick">
      <template #cell(add_to_cart)="data">
        <add-to-cart :product="data.item" btnTitle="OK" :withLabel="false"></add-to-cart>
      </template>
    </b-table>
  </div>
</template>

<script>
  import AddToCart from './AddToCart';
  export default {
    name: 'ProductList',
    data: () => ({
      products: [],
      columns: [
        { key: 'id', thClass: 'd-none', tdClass: 'd-none'},
        { key: 'title', label: 'Titre', sortable: true },
        { key: 'country', label: 'Nationalité' },
        { key: 'year', label: 'Année d\'édition' },
        { key: 'genre', label: 'Genres' },
        { key: 'ranking', label: 'Note' },
        { key: 'price', label: 'Prix' },
        { key: 'product_type', label: 'Type' },
        { key: 'add_to_cart', label: 'Ajouter au panier' }
      ]
    }),
    methods: {
      onRowClick(record, index) {
        var productId = record.id;
        this.$router.push({ name: 'product', params: { productId } })
      },
    },
    mounted() {
      axios.get('/api/products')
        .then(response => this.products = response.data['hydra:member']);
    },
    components: {
      'add-to-cart': AddToCart,
    },
  }
</script>

<style scoped>
  .b-table::v-deep > tbody > tr:hover {
    cursor: pointer;
  }
</style>