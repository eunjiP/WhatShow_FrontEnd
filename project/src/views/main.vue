<template>
  <main>
    <div class="slide__box">
      <div class="slide__list" @click="moveRight">
        <MovieItem v-for="(item, idx) in movieList" :key="idx" :item="item"></MovieItem>
      </div>
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
      itemIdx: 0,
    }
  },
  methods:{
    async getMovieList() {
      this.movieList = await this.$get('/movie/main', {});
    },
    
    moveSlide() {
      const slideList = document.querySelector('.slide__list');
      for (let i = 0; i < this.moveList.length; i++) {
        let trans = 100 * i;
        slideList.style.transform = `translate(-${trans}%)`;
      }
    },
    
    moveRight() {
      this.itemIdx++;
      if(this.itemIdx === this.movieList.length) {
        this.itemIdx = 0;
      }
      const slideList = document.querySelector('.slide__list');
      slideList.style.transform = `translate(-${this.itemIdx * 100}%)`;
      
    },
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
  main {
    color: #fff;
  }
  .slide {
      width: 100%;
      height: 100%;
      position: relative;
      }

  .slide__list {
      display: flex;
      transform: translate(0, 0);
      transition: 0.5s;
  }

  .slide__item {
      flex: 0 0 100%;
  }
</style>