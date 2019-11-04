import Vue from 'vue';
import VueRouter from 'vue-router';
import 'material-design-icons-iconfont/dist/material-design-icons.css'

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import { routes } from './routes';
import { store } from './store/store'
import wkSnackbar from './components/html/utils/winkelSnackbar.vue';
import VuetifyConfirm from 'vuetify-confirm';
import apiService from './apiService';
import VueAxios from 'vue-axios';
import VueMoment from 'vue-moment';

const vuetifyOptions = {
  defaultAssets: {
    font: true,
    icons: 'md'
  },
  icons: {
    iconfont: 'md',
  }
 }
const vuetify = new Vuetify(vuetifyOptions);

Vue.use(Vuetify);
Vue.use(VueRouter);


Vue.use(VueMoment);
Vue.use(VuetifyConfirm, {
  vuetify,
  buttonTrueText: 'Confirm',
  buttonFalseText: 'Cancel',
  color: 'warning',
  icon: 'warning',
  title: 'Warning',
  width: 350,
  property: '$confirm'
})
const mApiService = new apiService();
Vue.use(VueAxios, mApiService)

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
  document.title = to.meta.title
  if(!store.getters.hasToken){
    
     if(publicPath.indexOf(window.location.pathname)<0){
       window.location = '/login';
     }
  } else {
     next();
  }
});

import {
  mapGetters,
  mapMutations
} from "vuex";
const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify,
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
    computed:{
      ...mapGetters(['getStore','getActiveStore'])
    },
    methods: {
      ...mapMutations(['setActiveStores']),
      setStore(val){
        this.setActiveStores({activeStore:val});
        location.reload();
      },
      logOut(){
        store.commit('updateToken',{
          token:''
        })
        store.commit('clearStoreData')
        window.location = '/login';
      }
    },
});
