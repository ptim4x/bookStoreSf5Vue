<template>
  <span>
    <b-button v-for="(genre, index) in genres" :key ="index" disabled variant="outline-info" size="sm" class="mr-1">{{ genre }}</b-button>
  </span>
</template>

<script>
  export default {
    name: 'GenreTags',
    props: {
      genres: {
        required: true
      },
    },
  }
</script>

<style scoped>

</style>