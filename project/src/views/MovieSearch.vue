<template>
    <div class="container p-5">
        <div id="movie-search">
            <div id="search-header">
                <div class="search__title text-start">"{{ keyword }}" 검색 결과</div>
            </div>
            <div v-if="this.keyword == ''"></div>
            <div v-else>
                <div class="search__subTitle">
                    <div class="sub1"> 영화</div>
                    <div class="sub2" @click="more" style="cursor:pointer;">더보기</div>
                </div>
                <div class="search-body m-3">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4" id="keywordResult">
                            <div class="movie__poster col" v-for="(item, idx) in movie_info" :key="idx" :item="item">
                                <img :src="`${item.movie_poster}`" class="mt-3"/>
                                <div class="mb-3">{{ item.movie_nm }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="search__subTitle">
                    <div class="sub1"> 검색 장르 영화</div>
                    <div class="sub2" @click="more" style="cursor:pointer;">더보기</div>
                </div>
                <div class="search-body m-3">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4" id="genreResult">
                            <div class="movie__poster col" v-for="(item, idx) in movie_info2" :key="idx" :item="item">
                                <img :src="`${item.movie_poster}`" class="mt-3"/>
                                <div class="mb-3">{{ item.movie_nm }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="search__subTitle">
                    <div class="sub1"> # 태그 추천</div>
                    <div class="sub2">더보기</div>
                </div>
                <div class="search-body m-3">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                            <div class="movie__poster col" v-for="(item, idx) in movie_recommend_info" :key="idx" :item="item">
                                <img :src="`${item.movie_poster}`" class="mt-3"/>
                                <div class="mb-3">{{ item.movie_nm }}</div>
                            </div>
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
            movie_info2: [],
            movie_recommend_info: [],
            movie_tag: [],
            keyword: this.$route.params.keyword || '',  //mainHeader.vue에서 라우터를 이용해 보낸 파라미터로부터 데이터 받음 
            keyTag: this.$route.params.keyTag,
        }
    },

    created() {
        this.getMovieInfo(); // 영화 상세 정보
        this.getMovieInfoTag();
        this.getRecommendMovie();
    },

    computed:{
    },

    methods: {
        increment(){
            this.$store.commit('increment');
        },

        async getMovieInfo() {
            const param = {
                'keyword': this.keyword
            };
            this.movie_info = await this.$get('recommend/movieSearch', param);
            if (this.movie_info.length === 0) {
                const keywordResult = document.querySelector('#keywordResult');
                keywordResult.innerHTML = "<div class='resultNull'>검색 결과가 없습니다!</div>";
            } else {
                console.log(this.movie_info);
            }
        },

        async getRecommendMovie() {
            const param = {
                'iuser': parseInt(localStorage.getItem('iuser'))
            };
            console.log(param);
            this.movie_recommend_info = await this.$get('recommend/tagRecommend', param);
            // console.log(this.movie_recommend_info);
        },

        async getMovieInfoTag() { // 영화 상세 정보
            const param = {
                'keyword': this.keyword
            };
            this.movie_info2 = await this.$get(`/recommend/movieTagSearch`, param);
            if (this.movie_info2.length === 0) {
                const genreResult = document.querySelector('#genreResult');
                genreResult.innerHTML = "<div class='resultNull'>검색 결과가 없습니다!</div>";
            } else {
                console.log(this.movie_info);
            }
            console.log(this.movie_info2);
        },

        more() { // 검색 결과 더보기
            this.movielimit += 4;
            this.getMovieInfo();
            this.getMovieInfoTag();
        }
    },
}

</script>

<style scoped>
    /* 검색페이지 전체 */
    .container {
        background: var(--bg--black); border-radius: 10px;
        color: var(--white);
    }

    /* 검색어결과 타이틀 */
    .search__title {
        color: var(--subFont--color); font-size: 2rem; font-weight: bold;
    }

    /* 소제목 타이틀 */
    .search__subTitle {
        width: 100%;
        display: inline-block;
        vertical-align: middle;
        border-bottom: 1px solid var(--font--color);
        padding: 15px 10px;
        line-height: 2rem;
    }

    /* 소제목 */
    .sub1 {
        float: left;
        font-size: 1.5rem;
        color: var(--font--color);
        font-weight: bold;
    }

    /* 더보기 */
    .sub2 {
        float: right;

    }

    .movie__poster {
        text-align: center;

    }

</style>