export const state = () => ({
  datatable: {
    search: '',
    selected: [],
    headers: [],
  }
})

export const getters = {
  datatable: state => state.datatable
}

export const mutations = {
  PROMPT_DIALOG (state, payload) {
    payload = Object.assign(state.datatable, payload)
    state.datatable = payload
  },

  emptyState () {
    this.replaceState({ datatable: null })
  }
}

export const datatable = {
  namespaced: true,
  state,
  getters,
  mutations
}
