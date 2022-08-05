<template>
  <div>
    <header class="header"><mainHeader/></header>
    <div class="router">
      <router-link to="/">메인</router-link> |
      <router-link to="/detail">상세페이지</router-link>
      <router-view/>
    </div>
  </div>
</template>

<script>
import mainHeader from './components/mainHeader.vue'

export default {
  name: 'main',
  components: {
  mainHeader
  }
}

//휠 내리면 작아지게 자바스크립트 시작()
const header = document.querySelector(".header");
let timer;
window.scroll({top : 0, behavior: 'smooth'});
document.addEventListener('scroll', (e) =>{

    if(!timer){

        timer = setTimeout(()=>{
            timer = null;

            let top = document.documentElement.scrollTop;
            console.log(top)
            if(window.scrollY > 10){
                header.classList.toggle("d-none");
            }
            })}})

</script>

<style>
@font-face {
    font-family: 'round';
    src: url('../src/assets/font/Cafe24Ssurround.ttf') format('truetype');
}
@font-face {
    font-family: 'roundAir';
    src: url('../src/assets/font/Cafe24SsurroundAir.ttf') format('truetype');
}
  * {
    margin: 0;
    padding: 0;
    border-collapse: collapse;
    background: #152A35;
    font-family: roundAir;
  }

  .header{
    width: 100%;
    position: fixed;
  }

  .router {
    text-align: center;
    margin: 0 auto;
    padding: 10vh;
    
  }

  .d-none{
    display: none;
  }

</style>
