export const state = () => ({
  breadcrumbs: {
    items: [],
    leaf: null,
  }
})

export const getters = {
  breadcrumbs: state => state.breadcrumbs
}

export const mutations = {
  SET: (state, payload) => {
    state.breadcrumbs.items = payload.items
  }
}

export const actions = {
  set: ({commit}, payload) => {
    commit('SET', payload)
  }
}

export const breadcrumbs = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
