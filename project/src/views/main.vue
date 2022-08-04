<template>
  <main>
    <div class="main__movieList">
      <MovieItem v-for="(item) in movieList" :key="item.movie_code" :item="item"></MovieItem>
    </div>
  </main>
</template>

<script>
import MovieItem from '../components/mainMovieItem.vue';

export default {
  name: 'main',
  data() {
    return {
      movieList: []
    }
  },
  methods:{
    async getMovieList() {
      this.movieList = await this.$get('movie/main', {})
    }
  },
  components: {
    MovieItem,
  }
}
</script>

<style scoped>

</style>