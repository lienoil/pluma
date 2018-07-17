export const state = () => ({
  mediathumbnail: {
    visibility: false
  }
})

export const getters = {
  mediathumbnail: state => state.mediathumbnail
}

export const mutations = {
  SHOW_TOAST: (state, payload) => {
    payload = Object.assign(state.snackbar, payload, { model: true })
  }
}

export const actions = {
  showToast: (context, payload) => {
    context.commit('SHOW_TOAST', payload)
  },
  hideToast: (context, payload) => {
    context.commit('HIDE_TOAST', payload)
  }
}

export const mediathumbnail = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
