import Vue from 'vue';
import VueRouter from 'vue-router';

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import { routes } from './routes';
import { store } from './store/store'
import wkSnackbar from './components/html/utils/winkelSnackbar.vue';
import VuetifyConfirm from 'vuetify-confirm';
import apiService from './apiService';
import VueAxios from 'vue-axios'


Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(VuetifyConfirm);

Vue.use(VueAxios, apiService)

Vue.component(
  'login-form',
  require('./components/misc/Login.vue').default
);
Vue.component('wk-snackbar',wkSnackbar);

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {
  const publicPath = ['/login','/register','/'];
  if(!store.getters.hasToken){
    
     if(publicPath.indexOf(window.location.pathname)<0){
       window.location = '/login';
     }
  } else {
     next();
  }
});

const app = new Vue({
    el: '#app',
    router,
    store,
    data() {
        return {
            message: 'Hello',
            drawer: true,
            items: [
              { title: 'Home', icon: 'dashboard' },
              { title: 'About', icon: 'question_answer' }
            ],
            mini: true,
            right: null
        }
    },
    methods: {
      logOut(){
        store.commit('updateToken',{
          token:''
        })
        window.location = '/login';
      }
    },
});
