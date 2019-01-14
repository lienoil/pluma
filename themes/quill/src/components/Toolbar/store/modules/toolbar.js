export const state = () => ({
  toolbar: {
    model: '',
    title: '',
    search: '',
    searchField: false,
    searchButton: true,
    listGridView: true,
    toggleview: true,
  },
})

// export const getters = {
//   toolbar: state => state.toolbar
// }

export const mutations = {
  emptyState () {
    this.replaceState({ toolbar: null })
  },

  'UPDATE' (state, payload) {
    state.toolbar = Object.assign(state.toolbar, payload)
  },
}

export const actions = {
  update: ({ commit }, payload) => {
    commit('UPDATE', payload)
  },
}

export const toolbar = {
  namespaced: true,
  state,
  // getters,
  mutations,
  actions,
}
