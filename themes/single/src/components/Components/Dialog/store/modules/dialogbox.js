export const state = () => ({
  dialogbox: {
    model: false
  }
})

export const getters = {
  dialogbox: state => state.dialogbox
}

export const mutations = {
  PROMPT_DIALOG (state, payload) {
    payload = Object.assign(state.dialogbox, payload)
    state.dialogbox = payload
  }
}

export const dialogbox = {
  namespaced: true,
  state,
  getters,
  mutations
}
