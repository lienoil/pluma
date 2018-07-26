export const state = () => ({
  mediawindow: {
    // TODO: remove this, not recommended for multiple instance
    model: false,
  }
})

export const getters = {
  mediawindow: state => state.mediawindow
}

export const mutations = {
  TOGGLE: (state, payload) => {
    if (payload) {
      state.mediawindow.model = payload.model
    } else {
      state.mediawindow.model = !state.mediawindow.model
    }
  },
}

export const actions = {
  toggle: (context, payload) => {
    context.commit('TOGGLE', payload)
  },

  options: ({commit}, payload) => {
    commit('OPTIONS', payload)
  },
}

export const mediawindow = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
