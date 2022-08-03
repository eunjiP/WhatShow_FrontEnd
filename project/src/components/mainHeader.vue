<template>
  <header>
      <div class="header__left">
        <div>현재 위치</div>
        <div>채팅창</div>
        <div>마이페이지</div>
      </div>
      <div class="header__logo">
        <img src="../assets/img/logo.png">
      </div>
      <div class="header__right">
        <div class="header__search">
            <form action="#" method="post">
                <input type="text" name="search" placeholder="Search">
                <input type="submit" value="🔍">
            </form>
            <div class="search__bottom">상세검색</div>
        </div>
      </div>
  </header>
</template>

<script>
export default {

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
    width: 8rem;
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
</style>