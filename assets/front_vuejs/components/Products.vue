<template>
  <div>
    <b-table id="product-list" striped hover dark :items="products" :fields="columns" primary-key="id" @row-clicked="onRowClick"></b-table>
  </div>
</template>

<script>
    export default {
        name: 'ProductList',
        props: {},
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
            { key: 'product_type', label: 'Type' }
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
        }
    }
</script>

<style scoped>
  .b-table::v-deep > tbody > tr:hover {
    cursor: pointer;
  }
</style>