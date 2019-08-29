window.axios = require('axios');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import router from './router'
// import store from './store'
import './assets/sass/main.scss'
import Main from './components/Main.vue'


Vue.use(BootstrapVue)

new Vue({
  el: '#app',
  router,
  // store,
  render: h => h(Main)
})

