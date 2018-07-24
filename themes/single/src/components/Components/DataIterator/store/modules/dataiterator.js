export const state = () => ({
  dataiterator: {
    // Card
    cardHeight: '100%',
    hover: false,

    // Card Media
    cardMediaHeight: '160px',

    // Chip
    chip: false,

    // Card Text
    showCardText: true,

    // Card Actions
    showMimetype: true,
    showPart: true,

    // Pagination
    rowsPerPageItems: [3, 6, 9, 12, 'All'],
    pagination: {
      rowsPerPage: 3
    },

    // Toolbar
    showToolbar: true,
    toolbarFlat: true,
    toolbarClass: 'transparent',
    toolbarTitleClass: 'body-2',

    // File
    fileSizeClass: 'caption grey--text',

    // Grid System
    lg2: false,
    lg3: true,
    md2: false,
    md4: true,
    sm6: true,
    xs12: true,

    // Search
    search: '',

    // Bookmark
    bookmark: 'bookmark',
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
