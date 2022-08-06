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
      this.movieList = await this.$get('/movie/main', {})
    },/*
    async send_uid(){
      const senduid = localStorage.getItem(key, value)
      senduid = await this.$post('',{})
    },*/
    moveSlide() {
      const slideList = document.querySelector('.slide__list');
      for (let i = 0; i < this.moveList.length; i++) {
        let trans = 100 * i;
        slideList.style.transform = `translate(-${trans}%)`;
      }
    },
    create_uid(){
      if(!localStorage.getItem('uid')){
        localStorage.setItem('uid', 'user' + Math.floor(Math.random()*1000));
      }
    },
    moveRight() {
      this.itemIdx++;
      if(this.itemIdx === this.movieList.length) {
        this.itemIdx = 0;
      }
      const slideList = document.querySelector('.slide__list');
      slideList.style.transform = `translate(-${this.itemIdx * 100}%)`;
      
    }
  },
  created() {
    this.getMovieList(),
    this.create_uid(),
    this.send_uid()
  },
  components: {
    MovieItem,
  }
}
</script>

<style scoped>
  .slide {
      width: 100vw;
      position: relative;
      overflow: hidden;
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