<template>
  <header>
      <div class="header__left">
        <div>현재 위치</div>
        <div>채팅창</div>
        <div>마이페이지</div>
      </div>
      <div class="header__logo">
        <img src="../assets/logo.png">
      </div>
      <div class="header__right">
        <div class="header__search">
            <form action="" method="post">
                <input type="text" name="search" placeholder="Search">
                <input type="submit" value="🔍">
            </form>
            <div>상세검색</div>
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
    display: grid;
    grid-template-columns: 1fr 2fr 1fr;
  }
  .header__left {
    margin-left: 10%;
    display: flex;
    justify-content: space-around;
  }
  .header__logo {
    text-align: center;
  }
  .header__logo > img {
    width: 8rem;
  }
  .header__right {
    margin-right: 10%;
  }
  .header__search {
    display: grid;
    grid-template-rows: 1fr 1fr;
    text-align:end ;
  }
</style>