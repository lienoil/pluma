export const state = () => ({
  breadcrumbs: {
    model: true,
    items: [],
    // leaf: null,
  }
})

export const getters = {
  breadcrumbs: state => state.breadcrumbs
}

export const mutations = {
  'SET' (state, payload) {
    state.breadcrumbs.items = payload.items
  },

  'TOGGLE' (state, payload) {
    state.breadcrumbs.model = payload.model
  },
}

export const actions = {
  set: ({ commit }, payload) => {
    commit('SET', payload)
  },

  toggle: ({ commit }, payload) => {
    commit('TOGGLE', payload)
  },
}

export const breadcrumbs = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
