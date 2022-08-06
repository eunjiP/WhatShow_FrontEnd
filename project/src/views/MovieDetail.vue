<template>
  <div class="container p-5">
    <div id="movie-detail">
        <div id="detail-header" class="row justify-content-center">
            <div class="movie__title text-start">
                <h1> 미니언즈2 </h1>
                <span class="ms-2">Minions: The Rise of Gru, 2022</span>
            </div>
        </div>

        <div id="detail-main" class="row row-cols-2 justify-content-center">
            <div class="movie__poster col">
                <img src="http://www.joseilbo.com/gisa_img/16552590641655259064_joseedu.jpg" alt="poster">
            </div>

            <div class="movie__info col">
                <ul>
                    <li><strong>개요</strong> : 애니메이션, 모험, 코미디 <span>|</span> 미국 <span>|</span> 87분 </li>
                    <li><strong>개봉</strong> :  2022.07.20 </li>
                    <li><strong>등급</strong> :  전체관람가 </li>
                    <li><strong>감독</strong> :  카밀 발다 </li>
                    <li><strong>배우</strong> :  스티브 카렐, 타라지 P 헨슨, 양자경, 루시 로리스, 장 끌로드 반담, 피에르 꼬펑 </li>
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
                    세계 최고의 슈퍼 악당을 꿈꾸는 미니보스 ‘그루’와 그를 따라다니는 미니언들.
                    어느 날 그루는 
                    최고의 악당 조직 ‘빌런6’의 마법 스톤을 훔치는데 성공하지만 뉴페이스 미니언 
                    ‘오토’의 실수로 
                    스톤을 잃어버리고 빌런6에게 납치까지 당한다. 미니보스를 구하기 위해 잃어버린
                    스톤을 
                    되찾아야 하는 ‘오토’, 그리고 쿵푸를 마스터해야 하는 ‘케빈’, ‘스튜어트’, ‘밥’! 

                    올여름 극장가를 점령할 MCU(미니언즈 시네마틱 유니버스)가 돌아온다!
                </div>
            </div>
        </div>
        <div class="movie__time  my-5 col-12">
            <h4 class="fc-oran text-start">영화 상영시간</h4>
            <div class="day__selecte text-start">
                <input type="date" id="start-day"> - <input type="date" id="end-day">
            </div>

            <div class="movie__timeList">
                선택한 날의 상영시간
            </div>
        </div>
    </div>

    <div id="movie-review">
        <h4 class="fc-oran">당신의 감상을 들려주세요.</h4>
        <div class="star-rating space-x-4 mx-auto my-3">
            <input type="radio" id="5-stars" name="rating" value="5" v-model="ratings"/>
            <label for="5-stars" class="star pr-4">★</label>
            <input type="radio" id="4-stars" name="rating" value="4" v-model="ratings"/>
            <label for="4-stars" class="star">★</label>
            <input type="radio" id="3-stars" name="rating" value="3" v-model="ratings"/>
            <label for="3-stars" class="star">★</label>
            <input type="radio" id="2-stars" name="rating" value="2" v-model="ratings"/>
            <label for="2-stars" class="star">★</label>
            <input type="radio" id="1-star" name="rating" value="1" v-model="ratings" />
            <label for="1-star" class="star">★</label>
        </div>

        <div class="review__form row justify-content-center">
            <div class="review__input col-10">
                <textarea class="review__txt" @keyup="revLimit" placeholder="감상평을 남겨주세요. 영화와 상관없는 내용은 관리자에 의해 제재를 받을 수 있습니다."></textarea>
                <div class="review__limit">({{ limit }} / 100)</div>
            </div>
            <button class="review__btn ms-2 col-2">등록</button>
        </div>

        <div class="review__box">
            <div class="review__list">
                <div class="review__comment">
                    <div class="writer_info">
                        <div class="writer__img"></div>
                        <div class="writer__cre"></div>
                    </div>
                    <div class="review__cnt"></div>
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
            limit: 0,

        }
    },
    mounted() {
        this.initStarOffsets();
    },
   methods: {
    revLimit() { // 리뷰 글 수 제한
        const review_txt = document.querySelector('.review__txt');
        this.limit = review_txt.value.length;
        if(this.limit > 100) {
            review_txt.value = review_txt.value.substring(0, 100);
        }
    },
    


   }
}
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap');
    *{ color:#fff; }
    img { display: inline-block; width:100%; height:auto; border-radius: 15px;}
    li{ list-style: none;}

    .fc-yell { color: #F9F871; }
    .fc-oran { color: #F29B21; }

    .container { background: #00000088; border-radius: 10px;}
    /* ----- 영화 정보 ----- */
    .movie__title h1, .movie__title span { color: #F9F871; display: inline-block; font-family: 'Do Hyeon', sans-serif;}
    .movie__title h1 { font-size: 3.5rem;}
    .movie__title span { font-size: 1.5rem;}
    .movie__poster { width: 340px;}

    .movie__info li { font-size:1.2rem; text-align: left; padding:10px 5px; }
    .movie__info li span {color:gray;}
    /* 영화 줄거리  */
    .movie__intro__ctnt { border-top:1px solid #F29B21; padding: 15px 10px; line-height: 2rem;}

    /* ----- 상영날짜 선택 ----- */
    .movie__time input[type=date] { background-color: #32485388; padding: 5px; border: none; border-radius: 5px;}
    .movie__timeList { background-color: #32485388; border-radius: 5px; margin-top: 20px; height: 250px; text-align: center; line-height:250px;}

    /* ----- 별점 ----- 
    #myform { display: inline-block; direction: rtl; }
    #myform input[type=radio]{ display: none; }
    #myform label{
        font-size: 3em;
        color: transparent;
        text-shadow: 0 0 0 #f0f0f0;
    }
    #myform label:hover{ text-shadow: 0 0 0 #F9F871; }
    #myform label:hover ~ label{ text-shadow: 0 0 0 #F9F871; }
    #myform input[type=radio]:checked ~ label{ text-shadow: 0 0 0 #F9F871; }*/

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
 
.star-rating input {
  display: none;
}
 
.star-rating label {
  -webkit-text-fill-color: transparent; /* Will override color (regardless of order) */
  -webkit-text-stroke-width: 1px;
  cursor: pointer;
}
 
.star-rating :checked ~ label {
  -webkit-text-fill-color: gold;
}
 
.star-rating label:hover,
.star-rating label:hover ~ label {
    -webkit-text-fill-color: gold;
}

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


</style>