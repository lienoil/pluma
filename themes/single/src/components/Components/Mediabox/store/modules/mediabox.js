export const state = () => ({
  mediabox: {
    window: false,
    thumbnail: ''
  }
})

export const getters = {
  mediabox: state => state.mediabox
}

export const mutations = {
  SHOW_WINDOW: (state, payload) => {
    payload = Object.assign(state.mediabox, payload, { window: true })
  },
  HIDE_WINDOW: (state, payload) => {
    payload = Object.assign(state.mediabox, payload, { window: false })
  }
}

export const actions = {
  showWindow: (context, payload) => {
    context.commit('SHOW_WINDOW', payload)
  },
  hideWindow: (context, payload) => {
    context.commit('HIDE_WINDOW', payload)
  }
}

export const mediabox = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
