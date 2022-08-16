<template>
  <div class="slide__item">
    <div class="movieBox">
      <div>
        <b-badge variant="warning" class="badge-circle badge-lg badge-floating border-white">{{ item.rank }}위</b-badge>  
        {{ item.movie_nm }}
      </div>     
      <img class="movie__poster" :src="item.movie_poster" @click="showTime" alt="영화포스터">
    </div>

    <div class="movie__timeList d-none">
      <ul class="theater__List text-start">
        <li v-for="(schedule) in theater_list" :key="schedule.idx">
          {{ schedule.gname }} <!-- 극장명 -->
          <div class="theater__timeList">
            <ul class="d-inline ps-0" v-for="theater in schedule.theaterScheduleList" :key="theater.idx">
              <!-- {{theater.timetableList}} -->
              <li v-for="time in theater.timetableList" :key="time.idx">
                <a :href="time.ticketPcUrl" class="ticketUrl">
                  <div class="movie__runningTime">{{ time.rtime }} ~ {{ time.endTime }}</div>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>  
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
            timeList[i].classList.add('d-block');
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
  
        for(let a=0; a<list.length; a++) {
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
 .theater__timeList ul { background-color: #32485388;}
 .theater__timeList ul>li { display: inline-block; }
 .movie__runningTime { font-size:0.8rem; background-color: #F29B21; padding:5px; margin: 5px; border-radius: 5px; }
</style>