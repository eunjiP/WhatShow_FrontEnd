<template>
<<<<<<< HEAD

  <div class="col">
=======
  <div class="slide__item">
>>>>>>> a4dda22c7bb484167b0bf2c6960e5cff45505bc6
    <div>{{ item.movie_nm }}</div>
    <video class="videoPreview" muted width="800" height="500" :src="`${item.preview }`" :poster="`${item.movie_poster }`" ref="preview" @click="this.previewPlay"></video>
  </div>
</template>

<script>
export default {
    data() {
      return {
        previewValue: 0
      }
    },
    props: {
        item: Object
    },
    methods:{
      previewPlay() {
        if(!this.previewValue) {
          this.previewValue = 1;
          return this.$refs.preview.play();
        }
        this.previewValue = 0;
        return this.$refs.preview.load();
      }
    }
}
</script>

<style>
<<<<<<< HEAD
  .videoPreview{
      transition: 0.5s;
  }
  video{
    width: 300px;
  }
=======

>>>>>>> a4dda22c7bb484167b0bf2c6960e5cff45505bc6
</style>