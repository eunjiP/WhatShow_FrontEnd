<template>
  <main>
    <div class="slide__box">
      <div class="slide__list">
        <MovieItem v-for="(item, idx) in movieList" :key="idx" :item="item"></MovieItem>
      </div>
      <div class="buttons">
        <div class="slide__prev" @click="moveLeft"><i class="fa-solid fa-angle-left"></i></div>
        <div class="slide__next" @click="moveRight"><i class="fa-solid fa-angle-right"></i></div>
      </div>
      <div class="paginations"></div>
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
    moveRight() {
      this.itemIdx++;
      if(this.itemIdx === this.movieList.length) {
        this.itemIdx = 0;
      }
      const slideList = document.querySelector('.slide__list');
      slideList.style.transform = `translate(-${this.itemIdx * 100}%)`;
      
    },
    moveLeft() {
      this.itemIdx--;
      if(this.itemIdx === -1) {
        this.itemIdx = this.movieList.length-1;
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

  .buttons {
    cursor: pointer;
    font-size: 2rem;
  }

  .slide__prev {
    position: absolute;
    left: 5%;
    top: 50%;
  }

  .slide__next {
    position: absolute;
    right: 5%;
    top: 50%;
  }
</style>