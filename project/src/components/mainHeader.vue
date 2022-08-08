<template>
  <header>
    <!-- 헤더 왼쪽(모달) -->
    <div class="header__left">
      <!-- 현재 위치 -->
      <div>
        <div v-b-modal.modal-regin>현재 위치</div>

        <b-modal id="modal-regin" size="lg" title="위치 설정" header-bg-variant="secondary" header-text-variant="light" body-bg-variant="secondary" body-text-variant="light" hide-footer style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
          <p class="my-2">현재 위치로 설정하시겠습니까?</p>
          <br>
          <b-button @click="getLocation">현재 위치로 설정</b-button>
          <b-button v-b-modal.modal-regin2>수동 위치로 설정</b-button>
        </b-modal>

        <b-modal id="modal-regin2" title="수동 설정" header-bg-variant="secondary" 
        header-text-variant="light" body-bg-variant="secondary" body-text-variant="light" style="text-align: center; background-color: rgba(0, 0, 0, 0.5);" hide-footer>
          <div class="mr-2">수동으로 위치 설정</div>
          <select @change="changeOption1" v-model="optionList1">
              <option value="" selected>시/도</option>
              <option v-for="item in option1" :key="item.root_code" :value="item.root_code">
                {{ item.region_nm }}
              </option>
          </select>

          <select v-model="optionList2" v-if="optionList1 !== ''">
            <option value="0" selected>군/구</option>
            <option v-for="item in option2" :key="item.sub_code" :value="item.sub_code">
              {{ item.sub_nm }}
            </option>
          </select>

          <div>
            <b-button size="sm" variant="success" @click="ok()">설정</b-button>
            <b-button size="sm" variant="danger" @click="close()">취소</b-button> 
          </div>
        </b-modal>
      </div>

      <!-- 채팅창 -->
      <div>채팅창</div>
      
      <!-- 마이페이지 -->
      <div>
        <div v-b-modal.modal-mypage>마이페이지</div>

        <b-modal id="modal-mypage" title="마이페이지" header-bg-variant="secondary" header-text-variant="light" body-bg-variant="secondary" body-text-variant="light" footer-bg-variant="secondary" style="background-color: rgba(0, 0, 0, 0.5);" hide-footer>
          <div>
            <div class="mypage__user">
              <label for="input-file">
                <div>
                  <img src="../assets/mypage/avatar.svg" style="width:200px; cursor: pointer;"/>
                </div>
              </label>
              <input id="input-file" type="file" @change="uploadImages" accept="image/*" style="display: none"/>
              <div>
                <label for="input-nickname" style="font-size:20px; color:#F9F871;">닉네임</label>
                <button @click="change_nick">변경</button>
                <b-form-input id="input-nickname" class="nickname__input" placeholder="닉네임을 입력해주세요" v-model="WSnickname" @keyup.enter="change_nick"></b-form-input>
                <br>
                <label for="input-favtag" style="font-size:20px; color:#F9F871;">관심 태그</label>
                <br>
                <div class="d-inline" v-for="(item, idx) in userFav" :key="idx" :item="item" @click="delFav(idx)"><span class="favtag">#{{item}}</span></div>
                <b-form-input id="input-nickname" v-model="fav" class="favtag__input" @keyup.enter="inputFav()" placeholder="태그를 입력해주세요"/>
              </div>
            <br>
            </div>

  
            <div style="font-size: 20px; color:#F9F871;">내가 쓴 댓글</div>
            <div>[미니언즈2] 너무 귀여워요~</div>
            <div>[한산] 애국심이 불타오른다!!!!!</div>
            <div>[헤어질결심] 헤어지는게 뭐임?</div>
          </div>
        </b-modal>
      </div>
    </div>

    <!-- 헤더 중앙(로고) -->
    <div class="header__logo">
      <img src="../assets/img/logo.png">
    </div>

    <!-- 헤더 오른쪽(검색) -->
    <div class="header__right">
      <div class="header__search">
        <div class="search__input" method="post">
          <input id="search__text" type="text" @input="search" :value="searchKeyword" placeholder="검색어"/>
          <button class="search" type="submit"><i class="fa-solid fa-play" style="color:#fff; background-color: #F29B21;"></i></button>
        </div>
        
        <!-- 상세검색 -->
        <div v-b-modal.modal-search class="search__bottom">상세검색</div>

        <b-modal id="modal-search" title="검색하기" header-bg-variant="secondary" header-text-variant="light" body-bg-variant="secondary" body-text-variant="light" style="background-color: rgba(0, 0, 0, 0.5);" hide-footer>
          <b-form-input id="modal-search" type="text" @input="search" :value="searchKeyword" placeholder="검색어"/>
          <br>
          <div class="search__seltag" style="font-size:20px; color:#F9F871;">#태그설정</div>
          <br>
          <div class="container2">
            <div class="row">
              <div>
                <label v-for="item in gsTag" :key="item" class="col-3">
                  <input type="checkbox" name="genre" > {{ item }}
                </label>
              </div>
            </div>
          </div>
          <br>
          <br>
          <div class="search__recommend" style="font-size:20px; color:#F9F871;">추천 검색어</div>
          <br>
          <div>액션 범죄도시2 한산 멜로</div>
          <br>
          <button class="search__btn col-12" type="submit">검색하기</button>
        </b-modal>
      </div>
    </div>

  </header>
</template>

<script>
import modal from 'bootstrap/js/dist/modal';

  export default {
    name: 'mainHeader',
    data() {
      return {
        option1: [],
        option2: [],
        optionList1: '',
        optionList2: 0,
        WSuuid: localStorage.getItem('WSuuid'),
        WSnickname: localStorage.getItem('WSnickname'),
        userFav:[],
        fav:'',
        userLocation:'',
        gsTag: []
      }
    },
    created() {
      this.getOptionList1();
      this.create_uid();
      this.sel_uid();
    },
    mounted(){
    this.ins_uid();
  },
        
    created() {
      this.getOptionList1()
    },

    methods: {
      changeOption1() {
        this.optionList2 = 0;
        this.option2 = [];
        this.getOptionList2(this.optionList1);
      },
      async getOptionList1() {
        this.option1 = await this.$get(`/location/optionList1`, {})
      },
      async getOptionList2(optionList1) {
        this.option2 = await this.$get(`/location/optionList2/${optionList1}`, {})
      },
      uploadImages() {

      },
      async ins_uid(){
      const param = [this.WSuuid, this.WSnickname];
      const senduid = await this.$post(`/user/signup`,param);
      if(senduid){
        console.log();
      } else{
        console.error('error');
      }
    },
    async sel_uid(){
      let seluid = await this.$get(`/user/sel_user/${this.WSuuid}/${this.WSnickname}`,{});
      let selresult = seluid.result 
      console.log(seluid.result);
      console.log(typeof(seluid));
      selresult.forEach((item) => {
        console.log(item.value);
      })

      // for(let key in selresult){
      //   console.log(key, obj[key]);
      // }
    },
    async change_nick(){
      this.WSnickname = this.WSnickname;
      localStorage.setItem('WSnickname', this.WSnickname);
      let chNick = await this.$post(`/user/upd_nick/${this.WSnickname}`,{});
    },
    async inputFav(){
      console.log(this.fav);
      let inputfav = this.userFav.push(this.fav);
      await this.$post(`/user/ins_fav/${this.WSuuid}/${this.userFav}`,{});
      this.fav = '';
      console.log(this.userFav);
    },
    delFav(key){
      this.userFav.forEach((item,idx)=>{
        if(idx === key){
            this.userFav.splice(idx, 1);
        }
      })
    },
    create_uid(){
      if(!localStorage.getItem('WSuuid')){
        localStorage.setItem('WSuuid', Math.floor(Math.random()*1000),
        localStorage.setItem('WSnickname', 'user' + Math.floor(Math.random()*1000)));
      }
    },

    
      getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(this.showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
      },
      showPosition(pos) {
        let lat = pos.coords.latitude;
        let lng = pos.coords.longitude;
        // console.log(lat);
        // console.log(lng);
        this.getAddr(lat, lng);
      },
      getAddr(lat, lng) {
        let geocoder = new kakao.maps.services.Geocoder();
        let coord = new kakao.maps.LatLng(lat, lng);
        console.log(coord);
        let callback = function(result, status) {
          if (status === kakao.maps.services.Status.OK) {
              let detailAddr = !!result[0].road_address ? '<div>도로명주소 : ' + result[0].road_address.address_name + '</div>' : '';
  detailAddr += result[0].address.address_name;
              localStorage.removeItem('rootCode');
              localStorage.removeItem('subCode');
              localStorage.setItem('my_addr', detailAddr);
          }
        }
        geocoder.coord2Address(coord.getLng(), coord.getLat(), callback);
      },
      ok() {
        localStorage.removeItem('my_addr');
        localStorage.setItem('rootCode', this.optionList1);
        localStorage.setItem('subCode', this.optionList2);
      },
      // 상세검색-장르 체크박스
      async getSelectTag() {
        this.gsTag = await this.$get(`/movie/getTag/`, {});
        console.log(this.gsTag);
      }
    }
  }
</script>

<style scoped>
  header {
    margin: 1% 5% 0 5%;
    display: grid;
    grid-template-columns: 1fr 2fr 1fr;
    color: #fff;
  }
  .header__left {
    margin-top: 15px;
    display: flex;
    justify-content: space-around;
  }
  .header__left div, .search__bottom, .header__search input[type=submit]{
    cursor: pointer;
  }
  .header__logo {
    text-align: center;
  }
  .header__logo > img {
    width: 5rem;
  }
  .header__search {
    margin-top: 15px;
    display: grid;
    grid-template-rows: 1fr 1fr;
    text-align:end ;
    line-height: 2rem;
  }
  .header__search input[type=text] {
    height: 1.5rem;
    background: #fff;
  }
  /* 위치지정_수동 */
  .form-select select { margin: 0 20px; width: 100px; height: 30px;
    text-align: center; font-size: 1rem; color: black;
  }
  #modal-regin2 select option { color: black; }

  /* 마이페이지 css */

  .mypage__user {
    display: grid;
    grid-template-columns: 1fr 1fr;
  }

  /* 검색 css */

  .search__input {
    overflow: hidden;
    vertical-align: middle;
    white-space: nowrap;
  }

  .search__input > #search__text {
    height: 30px;
    background: #00000088;
    color: #fff;
    border: none;
    font-size: 10pt;
    width: 200px;
  }

  .search__btn {
    background-color: #F29B21;
    border: none;
    border-radius: 10px;
    padding: 5px;
    color: #fff;
  }

  .favtag{
    display: inline-block;
    background-color: #F29B21;
    border-radius: 5px;
    margin: 2px;
    padding: 0 2px;
  }
  .d-inline{
    display: inline-block;
    cursor: pointer;
  }
  .user-info{
    text-align: center;
  }

</style>
