<template>
  <div class="container">
    <div id="detail-header" class="row">
        <div class="movie__title col">
            <h1>미니언즈2</h1>
            <p>Minions : The Rise of Gru</p>
        </div>

        <div class="movie__score col">
            평점
        </div>
    </div>

    <div id="detail-main" class="row row-col-2 justify-content-md-center">
        <div class="movie__poster col-6">
            <img src="http://www.joseilbo.com/gisa_img/16552590641655259064_joseedu.jpg" alt="poster">
        </div>

        <div class="movie__info col-6">
            <ul>
                <li>개봉일: <span> 2022.07.20 </span></li>
                <li>관람등급: <span> 전체관람가 </span></li>
                <li>장르: <span> 애니메이션, 모험, 코미디 </span></li>
                <li>국가: <span> 미국 </span></li>
                <li>러닝타임: <span> 87분 </span></li>
                <li>감독: <span> 카밀 발다 </span></li>
                <li>배우: <span> 스티브 카렐, 타라지 P 헨슨, 양자경, 루시 로리스, 장 끌로드 반담, 피에르 꼬펑 </span></li>
            </ul>
        </div>

        <div class="movie__recom">
            <div class="recom_good"><i class="fa-solid fa-thumbs-up"></i></div>
            <div class="recom_bad"><i class="fa-solid fa-thumbs-down"></i></div>
        </div>

        <div class="movie__intro">
            <h4 class="fc-oran text-start">영화소개</h4>
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

        <div class="movie__time  col-12">
            <h4 class="fc-yell">영화 상영시간</h4>
            <input type="date"> - <input type="date">
        </div>
    </div>

    <div id="movie-review">
        <h4 class="fc-yell">리뷰</h4>

        <div class="star__form col">
            <form class="mb-3" name="myform" id="myform" method="post">
                <input type="radio" name="reviewStar" value="5" id="rate1"><label for="rate1">★</label>
                <input type="radio" name="reviewStar" value="4" id="rate2"><label for="rate2">★</label>     
                <input type="radio" name="reviewStar" value="3" id="rate3"><label for="rate3">★</label>    
                <input type="radio" name="reviewStar" value="2" id="rate4"><label for="rate4">★</label>   
                <input type="radio" name="reviewStar" value="1" id="rate5"><label for="rate5">★</label>
            </form>								
        </div>

        <div class="review__form">
            <div class="review__input">
                <textarea row="1" cols="1" rows="1" class="review__txt" @keyup="revLimit" placeholder="감상평을 남겨주세요. 영화와 상관없는 내용은 관리자에 의해 재재를 받을 수 있습니다."></textarea>
                <div class="review__limit">({{ limit }} / 100)</div>
            </div>
            <button class="review__btn">등록</button>
        </div>

        <div class="review">
            <div class="sample__review"></div>
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
   methods: {
    revLimit() {
        const review_txt = document.querySelector('.review__txt');
        this.limit = review_txt.value.length;
        if(this.limit > 100) {
            review_txt.value = review_txt.value.substring(0, 100);
        }
    }
   }
}
</script>

<style>
    *{ color:#fff; }
    img { display: inline-block; width:100%; height:auto; border-radius: 15px;}
    li{ list-style: none;}

    .fc-yell { color: #F9F871; }
    .fc-oran { color: #F29B21; }

    .movie__title h1, p { color: #F9F871; }

    .movie__poster {width: 320px; }

    .movie__info li { font-size:1.2rem; text-align: left; padding:10px 5px; }

    /* 별점 */
    #myform { display: inline-block; direction: rtl; }
    #myform input[type=radio]{ display: none; }
    #myform label{
        font-size: 3em;
        color: transparent;
        text-shadow: 0 0 0 #f0f0f0;
    }
    #myform label:hover{ text-shadow: 0 0 0 #F9F871; }
    #myform label:hover ~ label{ text-shadow: 0 0 0 #F9F871; }
    #myform input[type=radio]:checked ~ label{ text-shadow: 0 0 0 #F9F871; }

    /* 리뷰 */
    #movie-review .review__input { position: relative; border: 1px solid#F29B21; border-radius: 10px;}
    #movie-review .review__input .review__txt {
        padding: 15px;
        margin-right: 15px;
        border:none;
        resize: none;
    }
    #movie-review .review__input .review__limit {
        position: absolute;
        bottom: 10px;
        right: 13px;
        color: rgba(51,51,51,.5);
        letter-spacing: -0.09px;
    }

    

    #movie-review .review__form .review__btn {
        background-color: #F29B21;
        border: none;
        border-radius: 10px;
        padding: 15px 25px;
    }


</style>