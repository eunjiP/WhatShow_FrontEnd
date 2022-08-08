import { createRouter, createWebHistory } from 'vue-router'
import main from '../views/main.vue'
import MovieDetail from '../views/MovieDetail.vue'
// import SearchResult from '../views/SearchResult.vue'

const routes = [
  {
    path: '/',
    name: 'main',
    component: main
  },
  {
    path: '/detail',
    name: 'detail',
    component: MovieDetail
  },
  // {
  //   path: '/SearchResult',
  //   name: 'SearchResult',
  //   component: SearchResult
  // }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
