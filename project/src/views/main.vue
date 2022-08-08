<template>
  <main>
    <div>{{WSuuid}}, {{WSnickname}}</div>  
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
      WSuuid: localStorage.getItem('WSuuid'),
      WSnickname: localStorage.getItem('WSnickname'),
    }
  },
  methods:{
    async getMovieList() {
      this.movieList = await this.$get('/movie/main', {});
    },
    async ins_uid(){
      const param = [this.WSuuid, this.WSnickname];
      const senduid = await this.$post(`/user/signup`,param);
      if(senduid){
        console.log();
      } else{
        console.error('error');
      }
    },
    async sel_uid(){
      let seluid = await this.$get(`/user/sel_user/${this.WSuuid}/${this.WSnickname}`,{});
      let selresult = seluid.result 
      console.log(seluid.result);
      console.log(typeof(seluid));
      selresult.forEach((item) => {
        console.log(item.value);
      })

      // for(let key in selresult){
      //   console.log(key, obj[key]);
      // }

    },
    moveSlide() {
      const slideList = document.querySelector('.slide__list');
      for (let i = 0; i < this.moveList.length; i++) {
        let trans = 100 * i;
        slideList.style.transform = `translate(-${trans}%)`;
      }
    },
    create_uid(){
      if(!localStorage.getItem('WSuuid')){
        localStorage.setItem('WSuuid', Math.floor(Math.random()*1000),
        localStorage.setItem('WSnickname', 'user' + Math.floor(Math.random()*1000)));
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
    this.getMovieList(),
    this.create_uid(),
    this.sel_uid()
  },
  mounted(){
    this.ins_uid()
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
      width: 100vw;
      position: relative;
      overflow-y: hidden;
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