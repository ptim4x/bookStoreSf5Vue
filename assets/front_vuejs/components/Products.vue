<template>
  <div>
    <b-table id="product-list" striped hover dark :items="products" :fields="columns" @row-clicked="onRowClick"></b-table>
  </div>
</template>

<script>
    export default {
        name: 'ProductList',
        props: {},
        data: () => ({
          products: [],
          columns: [
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
            // 'record' will be the row data from items
            // `index` will be the visible row number (available in the v-model 'shownItems')
            console.log(record); // This will be the item data for the row
          }
        },
        mounted() {
          axios.get('/api/products')
            .then(response => this.products = response.data['hydra:member']);
        }
    }
</script>

<style scoped>
  /* tr[role=row]:hover {
    cursor: pointer;
  } */
</style>