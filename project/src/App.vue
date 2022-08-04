<template>
  <div>
    <header><mainHeader/></header>
    <router-link to="/">메인</router-link>
    <router-link to="/detail">상세페이지</router-link>
    <router-view/>
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
</style>
