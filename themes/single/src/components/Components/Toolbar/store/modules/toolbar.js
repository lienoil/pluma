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
    grid: true,
    list: false,
    bulk: true,
    archive: true,
    raisedButton: true,
    raisedTitle: 'sdsdsd',
    searchField: false,
    searchButton: true,
    settings: true,
    dividerVertical: true,
    raisedColor: 'primary',
    raisedLink: 'tests/show'
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
  mutations
}
