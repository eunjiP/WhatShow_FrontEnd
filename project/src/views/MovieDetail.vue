<template>
    <div class="container p-5">
        <div id="movie-detail">
            <div id="detail-header" class="row justify-content-center">
                <div class="movie__title text-start"></div>
            </div>

            <div id="detail-main" class="row row-cols-2 justify-content-center">
                <div class="movie__poster col">
                    <img :src="movie_info.movie_poster" alt="poster">
                </div>

                <div class="movie__info col">
                    <ul>
                        <li><strong>개요</strong> : {{ movie_info.movie_genre }} <span>|</span> {{ movie_info.country }} <span>|</span> {{ movie_info.runing_time}} </li>
                        <li><strong>개봉</strong> :  {{ movie_info.open_date }} </li>
                        <li><strong>등급</strong> :  {{ movie_info.view_level }} </li>
                        <li><strong>감독</strong> :  {{ movie_info.director }} </li>
                        <li><strong>배우</strong> :  {{ movie_info.actor }} </li>
                    </ul>

                    <div class="movie__recom row">
                        <div class="movie__score col-5">
                            평점
                        </div>
                        <div class="recom_good col">
                            <div>추천 수</div>
                            <i class="fa-solid fa-thumbs-up"></i>
                        </div>
                        <div class="recom_bad col">
                            <div>비추천 수</div>
                            <i class="fa-solid fa-thumbs-down"></i>
                        </div>
                    </div>
                </div>

                <div class="movie__intro my-5 col-12">
                    <h4 class="fc-oran text-start">줄거리</h4>
                    <div class="movie__intro__ctnt">
                    <video :src="movie_info.preview" autoplay></video>
                    </div>
                </div>
            </div>

            <div id="movie__time"  class= "my-5 col-12">
                <h4 class="fc-oran text-start">영화 상영시간</h4>
                <div class="day__selecte text-start">
                    <input type="date" id="select-day" v-model="selectedDate">
                </div>

                <div class="movie__timeList">
                    <ul class="theater__List">
                        <li v-for="(theater) in scheduleList" :key="theater.idx">
                            <div class="movie__place"> {{ theater }} </div>
                        </li>
                    </ul> 
                </div>
            </div>
        </div>

        <div id="movie-review">
            <h4 class="fc-oran">당신의 감상을 들려주세요.</h4>
            <!-- <div class="star-rating space-x-4 mx-auto my-3">
                <input type="radio" id="5-stars" name="rating" value="5" v-model="ratings"/>
                <label for="5-stars" class="star pr-4">★</label>
                <input type="radio" id="4-stars" name="rating" value="4" v-model="ratings"/>
                <label for="4-stars" class="star">★</label>
                <input type="radio" id="3-stars" name="rating" value="3" v-model="ratings"/>
                <label for="3-stars" class="star">★</label>
                <input type="radio" id="2-stars" name="rating" value="2" v-model="ratings"/>
                <label for="2-stars" class="star">★</label>
                <input type="radio" id="1-star" name="rating" value="1" v-model="ratings"/>
                <label for="1-star" class="star">★</label>
            </div> -->

            <div class="review__form row justify-content-center">
                <div class="review__input col-10">
                    <textarea class="review__txt" @keyup="revLimit" placeholder="감상평을 남겨주세요. 영화와 상관없는 내용은 관리자에 의해 제재를 받을 수 있습니다."></textarea>
                    <div class="review__limit">({{ limit }} / 100)</div>
                </div>
                <button class="review__btn ms-2 col-2">등록</button>
            </div>

            <div class="review__box">
                <div class="review__list" v-for="review in rev_list" :key="review.i_review">
                    <div class="review__comment">
                        <div class="writer__score">★★★★★</div>
                        <div class="review__cnt">{{ review.ctnt }}</div>

                        <div class="writer__info">
                            <span class="writer">{{ review.iuser }}</span>
                            <span class="writer__cre">{{ review.created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="review__more">
                    <button class="more__btn mt-3">
                        <span> 더 보기 <i class="fa-solid fa-angle-down"></i></span>
                    </button>
                </div>
            </div> 
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            movie_code: 81888,
            movie_info: [],
            selectedDate: '2022-08-08',
            scheduleList: [], //극장별 상영정보
            limit: 0,
            rev_list: [],
            rootCode: localStorage.getItem('rootCode'),
            subCode: localStorage.getItem('subCode')
        }
    },
    created() {
        this.getMovieInfo(); // 영화 상세 정보
        this.getDate(); // 상영시간
        this.getReview(); // 리뷰 리스트
    },
    
    // computed: {
    //     openDate() { // 영화 개봉일 가공
    //         return this.movie_info.open_date.replaceAll('-', '.');
    //     },
    // },
    methods: {   
        async getMovieInfo() { // 영화 상세 정보
            this.movie_info = await this.$get(`/detail/movieInfo/${this.movie_code}`, {});
            const movie_nm = this.movie_info.movie_nm;
            this.movieTitle(movie_nm);
        },

        movieTitle(nm) { // 영화 제목
            const movieTitleBox = document.querySelector('.movie__title');
            const movie__mainTitle = document.createElement('h1');
            const movie__serveTitle = document.createElement('span');
            movie__mainTitle.style.cssText = 
            "color: #F9F871; display: inline-block; font-family: 'Do Hyeon', sans-serif; font-size: 3.5rem;";
            movie__serveTitle.style.cssText = 
            "color: #F9F871; display: inline-block; font-family: 'Do Hyeon', sans-serif; margin-left:10px; font-size: 1.8rem;";

            if(nm.indexOf(':') !== -1) {
                const movieTitle = nm.split(':');
                movie__mainTitle.append(movieTitle[0]);
                movie__serveTitle.append(":" + movieTitle[1]);
                movieTitleBox.append(movie__mainTitle, movie__serveTitle);
            } else {
                movie__mainTitle.append(nm);
                movieTitleBox.append(movie__mainTitle);
            }
        },

        async getDate() { // 상영시간
            const param = {};
            param['code'] = this.movie_code;
            param['date'] = this.selectedDate;
            param['rootCode'] = this.rootCode;
            param['subCode'] = this.subCode;

            this.scheduleList = await this.$get('/movie/movieTime', param);

            const theater = this.scheduleList;// 극장 리스트
            console.log(theater);
            for(let a=0; a<theater.length; a++) {
                const t_list = theater[a].theaterScheduleList; // 극장 상영관
                for(let b=0; b<t_list.length; b++) {   
                    this.scheduleList = t_list[b].timetableList; // 상영관별 상영시간
                    console.log(this.scheduleList[b]); 
                }   
            }
        },

        async getReview() { // 리뷰 리스트 
            this.rev_list = await this.$get(`/detail/reviewList/${this.movie_code}`, {});
        },

        revLimit() { // 리뷰 글 수 제한
            const review_txt = document.querySelector('.review__txt');
            this.limit = review_txt.value.length;
            if(this.limit > 100) {
                review_txt.value = review_txt.value.substring(0, 100);
            }
        },
        
    },

}

</script>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap');
    * { color:#fff; }
    img { display: inline-block; width:100%; height:auto; border-radius: 15px;}
    li{ list-style: none;}

    .fc-yell { color: #F9F871; }
    .fc-oran { color: #F29B21; }

    .container { background: #00000088; border-radius: 10px;}

    /* ----- 영화 정보 ----- */
    .movie__poster { width: 340px;}

    .movie__info li { font-size:1.2rem; text-align: left; padding:10px 5px; }
    .movie__info li span {color:gray;}

    /* 영화 줄거리  */
    .movie__intro__ctnt { border-top:1px solid #F29B21; padding: 15px 10px; line-height: 2rem;}
    .movie__intro__ctnt video { width:80%; height:auto;}

    /* ----- 상영날짜 ----- */
    #movie-time input[type=date] { background-color: #32485388; padding: 5px; border: none; border-radius: 5px;}
    .movie__timeList { background-color: #32485388; border-radius: 5px; margin-top: 20px; height: auto; overflow:hidden;}
    .theater__List li { padding: 10px 15px; border: 1px solid #fff;}

    /* ----- 별점 ----- */
    .star-rating {
    display: flex;
    flex-direction: row-reverse;
    font-size: 3rem;
    line-height: 3.25rem;
    justify-content: space-around;
    padding: 0 0.2em;
    text-align: center;
    width: 5em;
    }
    
    .star-rating input { display: none; }
    
    .star-rating label {
    -webkit-text-fill-color: transparent; /* Will override color (regardless of order) */
    -webkit-text-stroke-width: 1px;
    cursor: pointer;
    }
    
    .star-rating :checked ~ label { -webkit-text-fill-color: gold; }
    
    .star-rating label:hover,
    .star-rating label:hover ~ label { -webkit-text-fill-color: gold; }

    /* ----- 리뷰 ----- */
    #movie-review .review__input { position: relative; height:90px; }
    #movie-review .review__input .review__txt {
        padding: 15px;
        border:none;
        resize: none;
        width:100%;
        height:100%;
        box-sizing: border-box;
        border: 1px solid#F29B21; border-radius: 10px;
        background: transparent;
    }
    #movie-review .review__input .review__limit {
        position: absolute;
        bottom: 12px;
        right: 20px;
        color: #F29B21;
        letter-spacing: -0.09px;
    }
    #movie-review .review__form .review__btn {
        background-color: #F29B21;
        border: none;
        border-radius: 10px;
        width: 95px; height:90px;
        padding: 5px 20px;
    }

    .review__box .more__btn { border:none; background: transparent;}

    /* ----- 리뷰 리스트 ----- */
    .review__comment { border-bottom:1px solid #535e6488; margin:10px auto; padding:15px; width:90%; overflow: hidden; text-align: left; }
    .writer__score { display: inline-block; width:100px;}
    .writer__info .writer__cre { font-size:0.8rem; color:gray;  }
    .writer__info .writer { color: #F29B21; font-family: 'round'; margin-right:10px; }


</style>