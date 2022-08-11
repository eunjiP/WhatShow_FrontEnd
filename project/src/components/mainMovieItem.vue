<template>
  <div class="slide__item">
    <div>
      <b-badge variant="warning" class="badge-circle badge-lg badge-floating border-white">{{ item.rank }}위</b-badge>  
      {{ item.movie_nm }}
    </div>
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

</style>