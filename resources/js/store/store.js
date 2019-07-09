
import Vue from 'vue'
import Vuex from 'vuex'
import snackbar from './module/snackbar';
import token from './module/token';
import moduleStore from './module/store';
import VuexPersistence from 'vuex-persist'

const vuexLocal = new VuexPersistence({
    key: 'vuex', // The key to store the state on in the storage provider.
    storage: window.localStorage,
  })
Vue.use(Vuex)

export const store = new Vuex.Store({
    modules:{
        snackbar,
        token,
        store:moduleStore
    },
    plugins: [vuexLocal.plugin]
})