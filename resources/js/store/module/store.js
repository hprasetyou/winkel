import apiService from '../../apiService';
const state = {
    activeStore:false,
    store:[]
  }
const mutations = {
    setStores(state, payload) { 
        state.store = payload.store;  
    },
    setActiveStores(state,payload) {
        state.activeStore = payload.activeStore;
    },
    clearStoreData(state){
        state.activeStore = false;
        state.store=[];
    }
}
const getters = {
    getStore(state){
        return state.store.map(item => ({value:item.id,text:item.name}));
    },
    getActiveStore(state) {
        let activeStore = state.activeStore
        const selectedStore = state.store.filter(store => store.id == activeStore);
        
        if(!activeStore || selectedStore.length < 1){
            if(state.store.length > 0){
                activeStore = state.store[0].id
            }else{
                activeStore = false
            }
        }
        return activeStore;
    }
}
const actions = {
    getStoreFromApi(context){
        const mApiService = new apiService(context.getters.getToken);
        mApiService.get(`/api/store`).then(o=>{
            context.commit('setStores',{store:o.data.data});
        })
    }
}
export default {
    state,
    mutations,
    actions,
    getters
}