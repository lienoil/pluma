export const state = () => ({
  toolbar: {
    model: '',
    title: '',
    search: '',
    toolbarClass: 'sticky v-toolbar__main',
    color: 'primary',
    flat: true,
    themeDark: true,
    spacer: true,
    sort: true,
    filter: true,
    toggleview: false,
    bulkdestroy: true,
    archive: true,
    raised: true,
    raisedButton: true,
    raisedTitle: 'Create',
    raisedColor: 'primary',
    raisedLink: '',
    searchField: false,
    searchButton: true,
    settings: true,
    dividerVertical: true,
  },
})

export const getters = {
  toolbar: state => state.toolbar
}

export const mutations = {
  emptyState () {
    this.replaceState({ toolbar: null })
  },

  'UPDATE' (state, payload) {
    state.toolbar = Object.assign(state.toolbar, payload)
  },
}

export const actions = {
  update: ({commit}, payload) => {
    commit('UPDATE', payload)
  },
}

export const toolbar = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
