export const state = () => ({
  folder: {
    // Toggle
    model: false,

    context: {
      show: false,
      x: 0,
      y: 0
    },

    renaming: false,

    id: null,
    folders: [],
    data: {}
  }
})

export const getters = {
  folder: state => state.folder
}

export const mutations = {
  'OPEN_CONTEXTMENU' (state, payload) {
    state.folder.context.show = payload.show
    state.folder.context.x = payload.x
    state.folder.context.y = payload.y
    state.folder.data = payload.data
    state.folder.folders = payload.folders
    state.folder.id = payload.id
  },

  'CLOSE_CONTEXTMENU' (state) {
    state.folder.context.show = false
    state.folder.context.x = 0
    state.folder.context.y = 0
  },

  'RENAME_FILE' (state, payload) {
    state.folder.data = payload
    state.folder.data.renaming = payload.renaming
  },

  emptyState () {
    this.replaceState({ folder: null })
  }
}

export const actions = {
  openContextMenu: ({commit}, payload) => {
    commit('OPEN_CONTEXTMENU', payload)
  },

  rename: ({commit}, payload) => {
    commit('RENAME_FILE', payload)
  }
}

export const folder = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
