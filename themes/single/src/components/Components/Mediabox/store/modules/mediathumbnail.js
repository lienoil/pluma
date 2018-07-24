export const state = () => ({
  mediathumbnail: {
    visibility: false,
    item: null
  }
})

export const getters = {
  mediathumbnail: state => state.mediathumbnail
}

export const mutations = {
  SET: (state, payload) => {
    state.mediathumbnail.item = payload.item
  },

  UNSET: (state, payload) => {
    state.mediathumbnail.item = null
  },
}

export const actions = {
  set: ({commit}, payload) => {
    commit('SET', payload)
  },

  unset: ({commit}, payload) => {
    commit('UNSET', payload)
  },
}

export const mediathumbnail = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
