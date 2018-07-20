export const state = () => ({
  dataiterator: {
    // Card Text
    showCardText: true,

    // Card Actions
    showPart: true,
    showMimetype: true,

    // Toolbar
    showToolbar: true,

    // Pagination
    rowsPerPageItems: [4, 8, 12],
    pagination: {
      rowsPerPage: 4
    },

    toolbarTitleClass: 'body-2',
    toolbarFlat: true,
    toolbarClass: 'transparent',
    fileSizeClass: 'caption grey--text',
    lg3: true,
    hover: false,
    cardHeight: '100%',
    cardMediaHeight: '160px',
  }
})

export const getters = {
  dataiterator: state => state.dataiterator
}

export const mutations = {
  PROMPT_DIALOG (state, payload) {
    payload = Object.assign(state.dataiterator, payload)
    state.dataiterator = payload
  },

  emptyState () {
    this.replaceState({ dataiterator: null })
  }
}

export const dataiterator = {
  namespaced: true,
  state,
  getters,
  mutations
}
