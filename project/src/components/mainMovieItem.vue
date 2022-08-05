<template>
  <div>
    <div>{{ item.movie_nm }}</div>
    <video class="videoPreview" muted width="800" height="500" :src="`${item.preview }`" :poster="`${item.movie_poster }`" @click="this.previewPlay"></video>
  </div>
</template>

<script>
export default {
    props: {
        item: Object
    },
    methods:{
      previewPlay() {
        this.play()
      }
    }
}
</script>

<style>
  .videoPreview{
      transition: 0.5s;
  }
</style>