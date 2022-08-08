<template>

</template>

<script>
export default ({
    // data () {
    //   return {
    //     SearchMovie : []
    //   }
    // },
    // mounted () { 
    //   this.getSearchMovie(); // MovieList가 화면에 랜더링 되었을 때 getMovieList 함수를 호출한다.
    // },
    // methods : {
    //   getSearchMovie : function(){ // API요청을 통해 영화목록을 받아온다.구보씨 일보
    //       let search = '미니언즈';
    //     //   const URL = "/v1/search/movie.json?query="+`${self}`+"&display=10&start=1&genre=1"; /*URL*/
    //       const URL = "/v1/search/movie.json?query="+`${search}`+"&section=all&ie=utf8"; /*URL*/
    //       const clientId = 'd68UHq382cT8ZrsbFZYj';
    //       const clientSecret = 'ugKvj9QWb1';

    //       this.$axios.get(URL,
    //           {headers : { 
    //                       'Accept' : 'application/json',
    //                       'X-Naver-Client-Id': clientId,
    //                       'X-Naver-Client-Secret': clientSecret}
    //           }).then((response) => { // 실제 API를 요청한다/
    //         console.log(response.data);
    //         let List = [];
    //         List = List.concat(response.data.items); // 받아온 데이터를 movieList 배열에 넣어준다.
    //         this.SearchMovie = this.SearchMovie.concat(List);
    //       })
    //   }
    // }
})
</script>

<style>

</style>