<template>
    <div class="container p-5">
        <div id="movie-search">
            <div id="search-header" class="col-12">
                <div class="search__title text-start">'빅샤크4' 검색 결과</div>
            </div>
            <div id="search__subTitle">
                <div id="sub1"> 영화</div>
                <div></div>
                <div id="sub2">더보기</div>
            </div>
            <div id="search-body">
                <div class="movie__poster col-3">
                    <img :src="movie_info.movie_poster" alt="poster">
                    <div>{{ movie_info.movie_nm }}</div>
                </div>
            </div>
            <br>
            <div id="search__subTitle">
                <div id="sub1"> 검색 장르 영화 추천</div>
                <div></div>
                <div id="sub2">더보기</div>
            </div>
            <div id="search-body">
                <div class="movie__poster col-3">
                    <img :src="movie_info.movie_poster" alt="poster">
                    <div>{{ movie_info.movie_nm }}</div>
                </div>
            </div>
            <br>
            <div id="search__subTitle">
                <div id="sub1"> # 태그 추천</div>
                <div></div>
                <div id="sub2">더보기</div>
            </div>
            <div id="search-body">
                <div class="movie__poster col-3">
                    <img :src="movie_info.movie_poster" alt="poster">
                    <div>{{ movie_info.movie_nm }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            movie_code: 210931,
            movie_info: []
        }
    },
    created() {
        this.getMovieInfo(); // 영화 상세 정보

    },
    methods: {   
        async getMovieInfo() { // 영화 상세 정보
            this.movie_info = await this.$get(`/detail/movieInfo/${this.movie_code}`, {});
        },
    },
}

</script>

<style scoped>
    .container { background: #00000088; border-radius: 10px;}

    #movie-search {
        color: white;
    }

    .search__title {
        color: #F9F871; font-size: 2rem; font-weight: bold;
    }

    #search__subTitle {
        width: 100%;
        display: inline-block;
        vertical-align: middle;
    }

    #sub1 {
        float: left;
        font-size: 1.5rem;
        color: #F29B21;
        font-weight: bold;
    }

    #sub2 {
        float: right;

    }

    .movie__poster {
        text-align: center;
    }
</style>