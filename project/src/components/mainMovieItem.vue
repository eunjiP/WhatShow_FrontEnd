<template>
  <div>
    <div>{{ item.movie_nm }}</div>
    <img :src="`${item.movie_poster}`">
  </div>
</template>

<script>
export default {
    props: {
        item: Object
    }
}
</script>

<style>

</style>