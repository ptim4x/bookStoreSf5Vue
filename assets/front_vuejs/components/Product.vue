<template>
	<b-container fluid> 
    <b-card bg-variant="dark" text-variant="white">
      <b-row class="justify-content-md-center"> 
        <b-col md="10">

          <b-row>
            <b-col md="7">
              <h3 >{{product.title}}</h3>
              <h5 v-if="product.original_title" >({{product.original_title}})</h5>
            </b-col>
            <b-col md="5" >
              <b-form-rating v-model="product.ranking" inline stars="10" readonly class="float-right"></b-form-rating>
            </b-col>
          </b-row>

          <b-tabs pills card class="mt-5">
            <b-tab title="Description" active><p class="product-description">{{ product.description }}</p></b-tab>
            <b-tab title="Détails">
              <h6><label >Titre : </label>{{ product.title }}</h6>
              <h6 v-if="product.original_title" ><label >Titre original : </label>{{ product.original_title }}</h6>
              <h6><label >Type : </label>{{ product.product_type }}</h6>
              <h6><label >Genres : </label><genre-tags :genres="product.genre"></genre-tags></h6>
              <h6><label >Année : </label>{{ product.year }}</h6>
              <h6><label >Pays : </label>{{ product.country }}</h6>
            </b-tab>
          </b-tabs>
          
          <b-row align-v="end">
            <b-col cols="4">
              <h4 >Prix : <span class="price">{{ product.price }} €</span></h4>
            </b-col>
            <b-col>
              <add-to-cart :product="product"></add-to-cart>
            </b-col>
          </b-row >

        </b-col>
      </b-row>
    </b-card>
  </b-container> 
</template>

<script>
  import AddToCart from './AddToCart';
  import GenreTags from './GenreTags';
  export default {
    name: 'Product',
    data: () => ({
      product: [],
      item_qty: 1
    }),
    mounted() {
      axios.get('/api/products/'+this.$route.params.productId)
        .then(response => this.product = response.data);
    },
    components: {
      'add-to-cart': AddToCart,
      'genre-tags': GenreTags,
    },
  }
</script>

<style scoped>
  .card {
    margin-top: 50px;
    background: #eee;
    padding: 3em;
    line-height: 1.5em; 
  }

  h3, h4, h5, h6 {
    text-transform: UPPERCASE;
    font-weight: bold; 
  }

  .price {
    color: #ff9f1a;
  }

  .add-to-cart:hover {
      background: #b36800;
      color: #fff; 
  }

  label {
    width: 8em;
    text-transform: none;
  }
</style>