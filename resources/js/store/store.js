
import Vue from 'vue'
import Vuex from 'vuex'
import snackbar from './module/snackbar';

Vue.use(Vuex)

export const store = new Vuex.Store({
    modules:{
        snackbar
    }
})