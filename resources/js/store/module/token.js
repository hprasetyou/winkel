const state={
    access_token:''
}
const mutations= {
    updateToken(state, payload){
        state.access_token = payload.token
    }
}
const getters = {
  hasToken(state) {
    return state.access_token.length > 0
  },
  getToken(state){
    return `Bearer ${state.access_token}`
  }
}
export default {
    state,
    getters,
    mutations
}