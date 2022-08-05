<template>
  <header>
    <!-- 헤더 왼쪽 -->
    <div class="header__left">
      <div>
        <!-- 현재 위치 -->
        <div v-b-modal.modal-regin>현재 위치</div>

        <b-modal id="modal-regin" size="lg" title="위치 설정" hide-footer style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
          <p class="my-2">현재 위치로 설정하시겠습니까?</p>
          <br>
          <b-button>현재 위치로 설정</b-button>
          <b-button v-b-modal.modal-regin2>수동 위치로 설정</b-button>
        </b-modal>

        <b-modal id="modal-regin2" hide-footer title="수동 설정" style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
          <div class="mr-2">수동으로 위치 설정</div>
          <select class="my-3" @change="changeLoca1" >
              <option value="" selected>시/도</option>
              <option v-for="item in localList1" :key="item.region_nm">
                {{ item.region_nm }}
              </option>
          </select>
          <select>
            <option value="" selected>군/구</option>
            <option v-for="item in localList1" :key="item.region_nm">
              {{ item.region_nm }}
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

        <b-modal id="modal-mypage" title="마이페이지" hide-footer style="background-color: rgba(0, 0, 0, 0.5);">
          <div>
            <div class="mypage__user">
              <label for="input-file">
                <div>
                  <img src="../assets/mypage/avatar.svg" style="width:200px; cursor: pointer;"/>
                </div>
              </label>
              <input id="input-file" type="file" @change="uploadImages" accept="image/*" style="display: none"/>
              <div>
                <label for="input-username" style="font-size:20px;">닉네임</label>
                <b-form-input id="input-username" class="login__form__username__input" type="text" style="background:white"/>
                <br>
                <div>#드라마 #액션 #멜로 #코미디 #호러</div>
                
              </div>
            <br>
            </div>
            <div style="font-size: 25px; font-weight: bold;">내가 쓴 댓글</div>
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

    <!-- 헤더 오른쪽 -->
    <div class="header__right">
      <div class="header__search">
          <form action="#" method="post">
              <input type="text" name="search" placeholder="Search">
              <input type="submit" value="🔍">
          </form>
          <div v-b-modal.modal-search class="search__bottom">상세검색</div>

          <b-modal id="modal-search" title="상세검색" hide-footer style="background-color: rgba(0, 0, 0, 0.5);">
          
        </b-modal>
      </div>
    </div>

  </header>
</template>

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
  #modal-regin2 select { margin: 0 20px; width: 100px; height: 30px;
    text-align: center; font-size: 1rem; color: black;
  }

  /* 마이페이지 css */

  .mypage__user {
    display: grid;
    grid-template-columns: 1fr 1fr;
  }

</style>

<script>
  export default {
    name: 'mainHeader',
    data() {
      return {
        localList1: [],
        localList2: [],
        selectedLoca1: '',
        selectedLoca2: ''
      }
    },
    created() {
      this.getLocalList();
      this.getLocalList1();
    },
    methods: {
      changeLoca1() {
        this.selectedLoca1 = '';
        this.localList2 = [];
        this.getLocalList2(this.selectedLoca1);
        this.getLocalList();
      },
      async getLocalList() {
        const param = {};
        if(this.selectedLoca2 > 0) {
          param['sub_nm'] = this.selectedLoca2;
        } else {
          if(this.selectedLoca1 !== '') {
            param['region_nm'] = this.selectedLoca1;
          }
          if(this.selectedLoca2 !== '') {
            param['sub_nm'] = this.selectedLoca2;
          }
        }
        this.localList = await this.$get('/src/main', param);
      },
      async getLocalList1() {
        this.localList1 = await this.getLocalList('/api/localList1', {});
      },
      async getLocalList2() {
        this.localList2 = await this.$get( `/api/localList2/${region_nm}`, {});
      },
      uploadImages() {

      }
    }

  }
</script>