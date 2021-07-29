<template>
  <div>
    <b-table fixed id="product-list" valign="middle" striped hover dark :items="products" :fields="columns" primary-key="id" @row-clicked="onRowClick">
      <template #cell(add_to_cart)="data">
        <add-to-cart :product="data.item" btnTitle="OK" :withLabel="false" size="sm"></add-to-cart>
      </template>
      <template #cell(genre)="data">
        <div class="text-truncate">
          <genre-tags :genres="data.item.genre"></genre-tags>
        </div>
      </template>
    </b-table>
    <b-pagination
      v-model="currentPage"
      :total-rows="totalRows"
      :per-page="perPage"
      @change="handlePageChange"
      align="center"
    ></b-pagination>
  </div>
</template>

<script>
  import AddToCart from './AddToCart';
  import GenreTags from './GenreTags';
  export default {
    name: 'ProductList',
    data: () => ({
      products: [],
      currentPage: 1,
      totalRows: 0,
      perPage: 30,
      columns: [
        { key: 'title', label: 'Titre', thClass: 'col-sm-3' },
        { key: 'country', label: 'Nationalité', thClass: 'col-sm-1 text-center', tdClass: 'text-center' },
        { key: 'year', label: 'Année', thClass: 'col-sm-0.75 text-center', tdClass: 'text-center' },
        { key: 'genre', label: 'Genres', thClass: 'col-sm-2' },
        { key: 'ranking', label: 'Note', thClass: 'col-sm-1 text-center', tdClass: 'text-center' },
        { key: 'price', label: 'Prix', formatter: value => { return value + '€' }, thClass: 'col-sm-1 text-center', tdClass: 'text-right pr-6' },
        { key: 'product_type', label: 'Type', thClass: 'col-sm-1'},
        { key: 'add_to_cart', label: 'Ajouter au panier'},
        { key: 'id', thClass: 'd-none', tdClass: 'd-none'},
      ]
    }),
    methods: {
      onRowClick(record, index) {
        var productId = record.id;
        this.$router.push({ name: 'product', params: { productId } })
      },
      handlePageChange(value) {
        this.currentPage = value;
        this.getProductsFromApi();
      },
      getProductsFromApi() {
        axios.get('/api/products?page='+this.currentPage)
          .then(response => {
            this.products = response.data['hydra:member'];
            this.totalRows = response.data['hydra:totalItems'];
          }
        );
      }
    },
    mounted() {
      this.getProductsFromApi();
    },
    components: {
      'add-to-cart': AddToCart,
      'genre-tags': GenreTags,
    },
  }
</script>

<style scoped>
  .b-table::v-deep > tbody > tr {
    cursor: pointer;
    vertical-align: middle;
  }
</style>