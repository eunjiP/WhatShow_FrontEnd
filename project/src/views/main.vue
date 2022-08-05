<template>
  <main>
    <div class="row">
      <MovieItem v-for="(item, idx) in movieList" :key="idx" :item="item" ></MovieItem>
    </div>
  </main>
</template>

<script>
import MovieItem from '../components/mainMovieItem.vue';

export default {
  name: 'main',
  data() {
    return {
      movieList: [],
    }
  },
  methods:{
    async getMovieList() {
      this.movieList = await this.$get('/movie/main', {})
    }
  },
  created() {
    this.getMovieList()
  },
  components: {
    MovieItem,
  }
}
</script>

<style scoped>

</style>