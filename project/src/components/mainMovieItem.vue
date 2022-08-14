<template>
  <div class="slide__item">
    <div>
      <b-badge variant="warning" class="badge-circle badge-lg badge-floating border-white">{{ item.rank }}위</b-badge>  
      {{ item.movie_nm }}
    </div>
    <!-- <video class="videoPreview" muted width="800" height="500" :src="`${item.preview }`" :poster="`${item.movie_poster }`" ref="preview" @click="this.previewPlay"></video> -->
    <div class="show__movieBox d-flex justify-content-center ">
      <img class="movie__poster" :src="item.movie_poster" @click="showTime" alt="영화포스터">

      <div class="movie__timeList">
        <ul class="theater__List text-start">
          <li v-for="schedule in theater_list" :key="schedule.idx">
            {{ schedule.gname }} <!-- 극장명 -->
            <div class="theater__timeList">
              <ul v-for="theater in schedule.theaterScheduleList" :key="theater.idx">
                <li v-for="time in theater.timetableList" :key="time.idx">
                    <a :href="time.ticketPcUrl" class="ticketUrl">
                      <div class="movie__runningTime">{{ time.rtime }} ~ {{ time.endTime }}</div> <!-- 상영시간 -->
                      <!-- <div class="movie__detailTheater">{{ time.tname }}</div> 상영관 -->
                    </a>
                </li>
              </ul>
            </div>
          </li>
        </ul> 
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
        theater_list: [],
      }
    },
    props: {
        item: Object
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

      async showTime() {
        
        const param = {
          'code': this.item.movie_code,
          'date': this.todayDate.substring(0, 10),
          'rootCode': this.rootCode,
          'subCode': this.subCode,
        };
        console.log(param);

        const nowTime = this.todayDate.substring(11,16);
        const list = await this.$get('/movie/movieTime', param); // 상영 극장 정보
       
        for(let a=0; a<list.length; a++) {
          this.theater_list[a] = list[a]; // 극장이름
          let sche_list = list[a].theaterScheduleList;
          for(let b=0; b<sche_list.length; b++) {
            let time_list = sche_list[b].timetableList;

            for(let c=0; c<time_list.length; c++) {
              if(time_list[c].rtime < nowTime) {
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
 a{ text-decoration: none; color:var(--white);}
 .theater__timeList ul { background-color: #32485388;}
 .theater__timeList ul>li { display: inline-block; }
 .movie__runningTime { font-size:0.8rem; }
</style>