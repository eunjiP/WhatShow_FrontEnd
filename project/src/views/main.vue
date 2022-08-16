<template>
  <main>
    <div class="loading d-none"><img src="../assets/img/loading3.gif"></div>
    <div class="slide__box">
      <div class="slide__list">
        <MovieItem v-for="(item, idx) in movieList" :key="idx" :item="item"></MovieItem>
      </div>
      <div class="buttons">
        <div class="slide__prev" @click="moveLeft"><i class="fa-solid fa-angle-left"></i></div>
        <div class="slide__next" @click="moveRight"><i class="fa-solid fa-angle-right"></i></div>
      </div>
      <div class="paginations">
        <span class="dot" v-for="idx in movieList.length" :key="idx" @click="currentSlide(idx-1)"></span>     
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
    // showLoading() {
    //   const loadingElem = document.querySelector('.loading');
    //   loadingElem.classList.remove('d-none');
    // },
    // hideLoading() {
    //   const loadingElem = document.querySelector('.loading');
    //   loadingElem.classList.add('d-none');
    // },
    async getMovieList() {
      this.showLoading();
      this.movieList = await this.$get('/movie/main', {});
      this.hideLoading();
    },
    moveRight() {
      if(this.itemIdx >= this.movieList.length-1) {
        this.itemIdx = 0;
      } else {
        this.itemIdx++;
      }
      const slideList = document.querySelector('.slide__list');
      slideList.style.transform = `translate(-${this.itemIdx * 100}%)`;
      this.currentSlide(this.itemIdx);
    },
    moveLeft() {
      if(this.itemIdx <= 0) {
        this.itemIdx = this.movieList.length-1;
      } else {
        this.itemIdx--;
      }
      const slideList = document.querySelector('.slide__list');
      slideList.style.transform = `translate(-${this.itemIdx * 100}%)`;
      this.currentSlide(this.itemIdx);
    },
    currentSlide(idx) {
      const slideList = document.querySelector('.slide__list');
      const dots = document.querySelectorAll('.dot');
      for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slideList.style.transform = `translate(-${idx * 100}%)`;
      this.itemIdx = idx;
      dots[idx].className += " active";
    }, 
  },
  created() {
    this.getMovieList();
  },
  components: {
    MovieItem,
  }
}
</script>

<style scoped>
  .d-none {
    display: none;
  }
  main {
    color: var(--white);
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
  .paginations {
    text-align: center;
  }
  .dot {
  cursor: pointer;
  height: 10px;
  width: 10px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: var(--font--color);
}
</style>