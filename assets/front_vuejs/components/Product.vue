<template>
	<b-container fluid> 
    <router-link :to="{ name: 'products'}">Retour à la liste des produits</router-link>
    <b-card>
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
              <h6><label >Genres : </label>{{ product.genre }}</h6>
              <h6><label >Année : </label>{{ product.year }}</h6>
              <h6><label >Pays : </label>{{ product.country }}</h6>
            </b-tab>
          </b-tabs>
          
          <b-row class="align-items-end">
            <b-col>
              <h4 >Prix : <span class="price">{{ product.price }} €</span></h4>
            </b-col>
            <b-col class="action">
              <b-button class="add-to-cart float-right" @click="addToCart(product.id)">ajouter au panier</b-button>
            </b-col>
          </b-row >

        </b-col>
      </b-row>
    </b-card>
  </b-container> 
</template>

<script>
  export default {
    name: 'Product',
    props: {},
    data: () => ({
      product: [],
    }),
    methods: {
      addToCart(productId) {
        // 'record' will be the row data from items
        // `index` will be the visible row number (available in the v-model 'shownItems')
        console.log(productId); // This will be the item data for the row
        this.$store.dispatch('incrementTotalItems');
      }
    },
    mounted() {
      axios.get('/api/products/'+this.$route.params.productId)
        .then(response => this.product = response.data);
    }
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

  label {
    width: 5em;
  }
</style>