const state = {
    visible: false,
    text: null,
    timeout: 6000,
    multiline: false,
    color:null
  }
const mutations = {
    showSnackbar(state, payload) {        
      state.text = payload.text
      state.color = payload.color
      state.multiline = (payload.text.length > 50) ? true : false
      
      if (payload.multiline) {
        state.multiline = payload.multiline
      }
      
      if (payload.timeout) {
        state.timeout = payload.timeout
      }

      state.visible = true
    },
    closeSnackbar(state) {
      state.visible = false
      state.multiline = false
      state.timeout = 6000
      state.text = null
    }
}
export default {
    state,
    mutations
}