<template>
  <div class="slide__item">
    <div class="movieBox">
      <div>
        <b-badge variant="warning" class="badge-circle badge-lg badge-floating border-white">{{ item.rank }}위</b-badge>  
        {{ item.movie_nm }}
      </div>     
      <img class="movie__poster" :src="item.movie_poster" @click="showTime" alt="영화포스터">
    </div>

    <div class="movie__timeList d-none container">
      <div class="row row-cols-2">
        <div class="preview__box col row align-items-center">
          <span v-if="item.preview == null" class="text-center" >예고편 없음 </span>
          <video v-else :src="item.preview" autoplay loop class="flex-fill w-50"></video>
        </div>
        <div class="row">
          <span class="close position-absolute top-0 end-0" @click="close"><i class="fa-solid fa-xmark"></i></span>
          <ul class="theater__List text-start col p-5">
            <li v-for="(schedule) in theater_list" :key="schedule.idx" class="col ">
              {{ schedule.gname }} <!-- 극장명 -->
              <div class="theater__timeList">
                <ul class=" d-inline ps-0" v-for="theater in schedule.theaterScheduleList" :key="theater.idx">
                  <li v-for="time in theater.timetableList" :key="time.idx">
                    <a :href="time.ticketPcUrl" class="ticketUrl">
                      <div class="movie__runningTime">{{ time.rtime }} ~ {{ time.endTime }}</div>
                    </a>
                  </li>
                </ul>
              </div>
            </li>  
          </ul>
          <span class="mb-5">자세한 상영 일정은 상세페이지를 확인해주세요.</span> 
        </div>        
      </div> 
    </div>
  </div>
</template>

<script>
export default {
    data() {
      return {
        previewValue: 0,
        todayDate: new Date(new Date().getTime() - (new Date().getTimezoneOffset() * 60000)).toISOString(),
        rootCode: localStorage.getItem('rootCode'),
        subCode: localStorage.getItem('subCode'),
        myAddr: localStorage.getItem('my_addr'),
        theater_list: [],
      }
    },
    props: {
        item: Object
    },
   
    created() {
      this.gettheaterList();
    },

    methods:{
      previewPlay() {
        if(!this.previewValue) {
          this.previewValue = 1;
          return this.$refs.preview.play();
        }
        this.previewValue = 0;
        return this.$refs.preview.load();
      },
      showTime() {
        const timeList = document.querySelectorAll('.movie__timeList');
        const moviePoster = document.querySelectorAll('.movie__poster');
        
        for(let i=0; i<timeList.length; i++) {
          moviePoster[i].addEventListener('click', function(e) {
            e.preventDefault();
            timeList[i].classList.remove('d-none');
            timeList[i].classList.add('d-block slide-fwd-center');
          })
        }
      },

      close() {
        const btn = document.querySelectorAll('.close');
        const timeList = document.querySelectorAll('.movie__timeList');
        for(let i=0; i<timeList.length; i++) {
          btn[i].addEventListener('click', function(e){
            e.preventDefault();

          timeList[i].classList.remove('d-block');
          timeList[i].classList.add('d-none');
        })
        }
      },

      async gettheaterList() {
          
        const param = {
          'code': this.item.movie_code,
          'date': this.todayDate.substring(0, 10)
        };
        if(this.rootCode == null) {
          param['my_addr'] = this.myAddr;
        } else {
          param['rootCode'] = this.rootCode;
          param['subCode'] = this.subCode;
        }

        const nowTime = this.todayDate.substring(11,16);
        const tt = nowTime.split(':'); 
        const tt2 = parseInt(tt[0])+3;
        
        const list = await this.$get('/movie/movieTime', param); // 상영 극장 정보
  
        for(let a=0; a<6; a++) {
          this.theater_list[a] = list[a]; // 극장이름
          let sche_list = list[a].theaterScheduleList;
          for(let b=0; b<sche_list.length; b++) {
            let time_list = sche_list[b].timetableList;
            for(let c=0; c<time_list.length; c++) {
              let mt = time_list[c].rtime.split(':');
              if(time_list[c].rtime < nowTime || mt[0] > tt2 ) {
                sche_list[b].timetableList.splice(c, 1); // 지난 상영시간 삭제
                c--;
              }               
            }        
          }          
        } 


      },

    

    }
}
</script>

<style>
 li{list-style: none;}
 a{ text-decoration: none; color:#fff;}
 .slide__item { position: relative; height: 600px;}
 .slide__item .movieBox{
    position: absolute; 
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    
  }
 .slide__item .movie__timeList {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    background-color: #000000a4;
    min-height: 400px;
  }


 .close { width: 45px; font-size:2rem;}
 .movie__poster { width: 250px; }

 .preview__box { background-color: black;}
 .slide__item .theater__timeList ul>li { display: inline-block; }
 .slide__item .movie__runningTime { font-size:0.8rem; background-color: #F29B21; padding:5px; margin: 5px; border-radius: 5px; }

 .slide-fwd-center {
	-webkit-animation: slide-fwd-center 0.45s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	        animation: slide-fwd-center 0.45s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}

@-webkit-keyframes slide-fwd-center {
  0% {
    -webkit-transform: translateZ(0);
            transform: translateZ(0);
  }
  100% {
    -webkit-transform: translateZ(160px);
            transform: translateZ(160px);
  }
}
@keyframes slide-fwd-center {
  0% {
    -webkit-transform: translateZ(0);
            transform: translateZ(0);
  }
  100% {
    -webkit-transform: translateZ(160px);
            transform: translateZ(160px);
  }
}

</style>