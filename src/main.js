// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'

Vue.config.productionTip = false

// import VuetableOne from './components/VuetableOne'
// import VuetableTwo from './components/VuetableTwo'
// import VueRouter from 'vue-router';

// const routes = [
//   { path: '/', component: App },
//   { path: '/two', component: VuetableTwo }
// ]

// const router = new VueRouter({
//   routes // short for `routes: routes`
// })

// const app = new Vue({
//   router
// }).$mount('#app')

/* eslint-disable no-new */
new Vue({
  el: '#app',  //renders on index page inside id tag
  components: { App },
  template: '<App/>'
})
