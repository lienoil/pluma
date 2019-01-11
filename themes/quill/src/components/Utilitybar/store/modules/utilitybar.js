export const state = () => ({
  utilitybar: {
    model: true,
    items: [],
  }
})

export const getters = {
  utilitybar: state => state.utilitybar
}

export const mutations = {
  'SET' (state, payload) {
    state.utilitybar.items = payload.items
  },

  'TOGGLE' (state, payload) {
    state.utilitybar.model = payload.model
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

export const utilitybar = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
