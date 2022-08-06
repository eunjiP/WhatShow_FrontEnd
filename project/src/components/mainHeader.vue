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
          <select calss="form-select" v-model="option1">
              <option value="" selected>시/도</option>
              <option v-for="item in option1" :key="item.root_code">
                {{ item.region_nm }}
              </option>
          </select>
          <select calss="form-select" v-model="option2" v-if="option1 !== ''" >
            <option selected >군/구</option>
            <option v-for="item in option2" :key="item.root_code" :value="item.subregion_nm" >
              {{ item.subregion_nm }}
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

        <b-modal id="modal-mypage" title="마이페이지" ok-only style="background-color: rgba(0, 0, 0, 0.5);">
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
                <b-form-input id="input-nickname" class="nickname__input" placeholder="닉네임을 입력해주세요"/>
                <br>
                <label for="input-favtag" style="font-size:20px; color:#F9F871;">관심 태그</label>
                <div>#드라마 #액션 #멜로 #코미디 #호러</div>
                <b-form-input id="input-nickname" class="favtag__input" @keyup.enter="this.value" placeholder="태그를 입력해주세요"/>
                
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

    <!-- 헤더 오른쪽 -->
    <div class="header__right">
      <div class="header__search">
        <form action="#" method="post">
            <input type="text" name="search" placeholder="검색"/>
            <button style="border:none;" type="submit"><i class="fa-solid fa-play" style="width:30px; color: #C57F1E;" ></i></button>
        </form>

        <!-- 상세검색 -->
        <div v-b-modal.modal-search class="search__bottom">상세검색</div>

        <b-modal id="modal-search" title="검색하기" hide-footer style="background-color: rgba(0, 0, 0, 0.5);">
          <b-form-input id="modal-search" class="detail__search" type="text" placeholder="검색어 입력"/>
          <br>
          <div class="search__seltag" style="font-size:20px; color:#F9F871;">#태그설정</div>
          <br>
          <div class="container">
            <div class="row">
              <div class="col-3">
                <label><input type="checkbox" name="genre"> 드라마</label>
              </div>
              <div class="col-3">
                <label><input type="checkbox" name="genre"> 멜로</label>
              </div>
              <div class="col-3">
                <label><input type="checkbox" name="genre"> 로맨스</label>
              </div>
              <div class="col-3">
                <label><input type="checkbox" name="genre"> 코미디</label>
              </div>
              <div class="col-3">
                <label><input type="checkbox" name="genre"> 전쟁</label>
              </div>
              <div class="col-3">
                <label><input type="checkbox" name="genre"> 호러</label>
              </div>
              <div class="col-3">
                <label><input type="checkbox" name="genre"> SF</label>
              </div>
              <div class="col-3">
                <label><input type="checkbox" name="genre"> 액션</label>
              </div>
            </div>
          </div>
          <br>
          <div class="search__recommend" style="font-size:20px; color:#F9F871;">추천 검색어</div>

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
  #modal-regin2 { color: black;}
  #modal-regin2 select { margin: 0 20px; width: 100px; height: 30px;
    text-align: center; font-size: 1rem; color: black;
  }
  #modal-regin2 select option { color: black; }

  /* 마이페이지 css */

  .mypage__user {
    display: grid;
    grid-template-columns: 1fr 1fr;
  }

  /* 상세검색 css */

</style>

<script>
  export default {
    name: 'mainHeader',
    data() {
      return {
        option1: [
          { region_nm: '서울', root_code: '1'},
          { region_nm: '경기', root_code: '2'},
          { region_nm: '대구', root_code: '3'},
          { region_nm: '부산', root_code: '4'},
        ],
        option2: [
          { subregion_nm: '용산구', root_code: '1'},
          { subregion_nm: '구로구', root_code: '1'},
          { subregion_nm: '서초구', root_code: '1'},
          { subregion_nm: '안양', root_code: '2'},
          { subregion_nm: '용산', root_code: '2'},
          { subregion_nm: '경기', root_code: '2'},
          { subregion_nm: '수성구', root_code: '3'},
          { subregion_nm: '동구', root_code: '3'},
          { subregion_nm: '동래구', root_code: '4'},
          { subregion_nm: '동작구', root_code: '4'},
        ]
      }
    },
    created() {

    },
    methods: {
      changeOption1() {
        this.option2 = '';
        this.option2
      },
      uploadImages() {

      },
    }

  }
</script>