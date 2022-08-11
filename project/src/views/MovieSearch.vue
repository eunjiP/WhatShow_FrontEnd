<template>
    <div class="container p-5">
        <div id="movie-search">
            <div id="search-header">
                <div class="search__title text-start">"{{ keyword }}" 검색 결과</div>
            </div>
            <div v-if="this.keyword == ''"></div>
            <div v-else>
                <div id="search__subTitle">
                    <div id="sub1"> 영화</div>
                    <div></div>
                    <div id="sub2" @click="more" style="cursor:pointer;">더보기</div>
                </div>
            <br>
            <div id="search-body">
                <br>
                <div id="search-body">
                    <br>
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                            <div class="movie__poster col" v-for="(item, idx) in movie_info" :key="idx" :item="item">
                                <img :src="`${item.movie_poster}`"/>
                                <div>{{ item.movie_nm }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            <br>
            </div>
            <div v-if="this.keyword == ''"></div>
            <div v-else>
                <div id="search__subTitle">
                    <br>
                    <div id="sub1"> 검색 장르 영화 추천</div>
                    <div></div>
                    <div id="sub2">더보기</div>
                </div>
                <div id="search-body">
                    <br>
                    <div class="movie__poster col-3">
                        <img :src="movie_info.movie_poster" alt="poster">
                        <div>{{ movie_info.movie_nm }}</div>
                    </div>
                </div>
            <br>
            </div>
            <div v-if="this.keyword == ''"></div>
            <div v-else>
                <div id="search__subTitle">
                    <div id="sub1"> # 태그 추천</div>
                    <div></div>
                    <div id="sub2">더보기</div>
                </div>
                <div id="search-body">
                    <br>
                    <div class="movie__poster col-3">
                        <img :src="movie_info.movie_poster" alt="poster">
                        <div>{{ movie_info.movie_nm }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {    
    name: "search",

    data() {
        return {
            movielimit: 4,
            movie_info: [],
            keyword: this.$route.params.keyword  //nav.vue에서 라우터를 이용해 보낸 파라미터로부터 데이터 받음 
        }
    },

    created() {
        this.getMovieInfo(); // 영화 상세 정보
    },

    computed:{
        count(){
            return this.$store.state.count;
        }
    },

    methods: {
        increment(){
            this.$store.commit('increment');
        },

        async getMovieInfo() { // 영화 상세 정보
            this.keyword = this.keyword;
            console.log(this.keyword);
            this.movie_info = await this.$get(`/movie/selSearch/${this.keyword}/${this.movielimit}`, {});
            // console.log(this.movie_info);
        },

        more() { // 검색 결과 더보기
            this.movielimit += 4;
            this.getMovieInfo();
        }
    },
}

</script>

<style scoped>
    /* 검색페이지 전체 */
    .container {
        background: #00000088; border-radius: 10px;
        color: white;
    }

    /* 검색어결과 타이틀 */
    .search__title {
        color: #F9F871; font-size: 2rem; font-weight: bold;
    }

    /* 소제목 타이틀 */
    #search__subTitle {
        width: 100%;
        display: inline-block;
        vertical-align: middle;
        border-bottom: 1px solid #F29B21;
        padding: 15px 10px;
        line-height: 2rem;
    }

    /* 소제목 */
    #sub1 {
        float: left;
        font-size: 1.5rem;
        color: #F29B21;
        font-weight: bold;
    }

    /* 더보기 */
    #sub2 {
        float: right;

    }

    .movie__poster {
        text-align: center;

    }
</style>