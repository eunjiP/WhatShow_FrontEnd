import { createApp } from 'vue'
import BootstrapVue from 'bootstrap-vue'
import '../node_modules/bootstrap/dist/css/bootstrap.css'
import '../node_modules/bootstrap-vue/dist/bootstrap-vue.css'
import App from './App.vue'
import router from './router'

createApp(App)
.use(router)
.use(BootstrapVue)
.mount('#app')
