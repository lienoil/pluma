export const state = () => ({
  folder: {
    // Toggle
    model: false,

    items: [], // or []

    // New Folder variables
    new: {
      model: false,
      name: 'New Folder',
      foldertype: { value: '', text: '' },
      type: 'folder',
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
  },

  file: {
    selected: {}
  },
})

export const getters = {
  folder: state => state.folder,
  file: state => state.file,
}

export const mutations = {
  'CREATE' (state, payload) {
    // TODO save to database
    let folder = JSON.parse(JSON.stringify(payload))
    state.folder.items.push(folder)
    console.log(state.folder.items)
  },

  'RENAME' (state, payload) {
    state.folder.renaming = payload.renaming
  },

  'SELECT_FILE' (state, payload) {
    state.file.selected = payload
  },

  'UNSELECT' (state) {
    state.file.selected = null
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
  },

  select: ({commit}, payload) => {
    if (payload.type === 'file') {
      commit('SELECT_FILE', payload)
    }
  },

  unselect: ({commit}) => {
    commit('UNSELECT')
  },
}

export const folder = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
