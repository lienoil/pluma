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
    data: {},

    // New Folder variables
    new: {
      model: false,
      name: 'New Folder',
      foldertype: '',
      color: 'goldenrod',
      code: 'new-folder',
    },

    // Foldertypes
    foldertypes: [
      { value: 'audio', text: 'Audios' },
      { value: 'video', text: 'Videos' },
      { value: 'book', text: 'Books' },
      { value: 'archive', text: 'Archives' },
      { value: 'image', text: 'Images' },
    ],
  }
})

export const getters = {
  folder: state => state.folder
}

export const mutations = {
  'CREATE' (state, payload) {
    state.folder = Object.assign(state.folder, payload)
  },

  'CLOSE_CONTEXTMENU' (state) {
    state.folder.context.show = false
    state.folder.context.x = 0
    state.folder.context.y = 0
  },

  'RENAME' (state, payload) {
    state.folder.renaming = payload.renaming
  },

  emptyState () {
    this.replaceState({ folder: null })
  }
}

export const actions = {
  create: ({commit}, payload) => {
    commit('CREATE', payload)
  },

  rename: ({commit}, payload) => {
    commit('RENAME', payload)
  }
}

export const folder = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
