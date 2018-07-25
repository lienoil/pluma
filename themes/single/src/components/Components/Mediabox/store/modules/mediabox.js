import Vue from 'vue'

export const state = () => ({
  mediabox: {
    window: false,
    thumbnail: '',
    toolbar: {
      details: {
        model: false,
      },
    },

    // Mediabox selected object
    selected: null,

    // Items
    items: null,
    total: 0,
  }
})

export const getters = {
  mediabox: state => state.mediabox
}

export const mutations = {
  SHOW_WINDOW: (state, payload) => {
    payload = Object.assign(state.mediabox, payload, { window: true })
  },

  HIDE_WINDOW: (state, payload) => {
    payload = Object.assign(state.mediabox, payload, { window: false })
  },

  SELECT: (state, payload) => {
    state.mediabox.selected = payload.selected
  },

  UNSELECT: (state) => {
    state.mediabox.selected = null
  },

  SET_ITEMS: (state, payload) => {
    state.mediabox.items = payload.items
  },

  FETCH: (state, payload) => {
    state.mediabox.items = payload.items
  },

  TOOLBAR: (state, payload) => {
    state.mediabox.toolbar = Object.assign(state.mediabox.toolbar, payload.toolbar)
  },
}

export const actions = {
  showWindow: (context, payload) => {
    context.commit('SHOW_WINDOW', payload)
  },

  hideWindow: (context, payload) => {
    context.commit('HIDE_WINDOW', payload)
  },

  select: ({commit}, payload) => {
    commit('SELECT', payload)
  },

  unselect: ({commit}) => {
    commit('UNSELECT')
  },

  set: ({commit}, payload) => {
    commit('SET_ITEMS', payload)
  },

  toolbar: ({commit}, payload) => {
    commit('TOOLBAR', payload)
  },

  async fetch ({commit}, payload) {
    Vue.$http.get('/api/v1/library/all')
      .then((response) => {
        commit('FETCH', response.body)
      })
      .catch((error) => {
        console.log(error.statusText)
      })
  }
}

export const mediabox = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
