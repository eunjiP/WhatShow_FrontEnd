<template>
    <div>
        <div>영화제목 : {{ SearchMovie.title }}</div>
        <div>영화예고편 : {{ SearchMovie.link }}</div>
    </div>
</template>

<script>
export default ({
    data() {
        return {
            SearchMovie: []
        }
    },
    created() {
        const axios = await axios.get("https://openapi.naver.com/");
    },
    mounted() {
        this.getSearchMovie();
    },
    methods: {
        getSearchMovie: function() {
            let search = '미니언즈';
            const URL = "/v1/search/movie.json?query="+`${search}`+"&section=all&ie=utf8"; /*URL*/
            const clientId = 'd68UHq382cT8ZrsbFZYj';
            const clientSecret = 'ugKvj9QWb1';
            this.$axios.get(URL, {
                Headers: {
                    'Accept' : 'application/json',
                    'X-Naver-Client-Id': clientId,
                    'X-Naver-Client-Secret': clientSecret
                }
            }).then((response) => { 
                    console.log(response.data);
                    let List = [];
                    List = List.concat(response.data.items); 
                    this.SearchMovie = this.SearchMovie.concat(List);
            })
        }
    }
})
</script>

<style>

</style>