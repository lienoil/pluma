// import menus from '@/components/Sidebar/config/sidebar';

export const state = () => ({
  sidebar: {
    model: window.localStorage.getItem('sidebar.model') === 'true',
    dark: window.localStorage.getItem('sidebar.dark', 'true') === 'true',

    clipped: window.localStorage.getItem('sidebar.clipped') === 'true',
    floating: window.localStorage.getItem('sidebar.floating') === 'true',
    mini: window.localStorage.getItem('sidebar.mini') === 'true',

    title: app.title,
    logo: app.logo,
    tagline: app.tagline,

    menus: [], // menus,
  },
})

export const getters = {
  sidebar: state => state.sidebar,
  menus: state => state.sidebar.menus,
}

export const mutations = {
  'TOGGLE' (state, payload) {
    state.sidebar.model = payload.model
  },

  'CLIP' (state, payload) {
    state.sidebar.clipped = payload.clipped
  },

  'UPDATE_SIDEBAR' (state, payload) {
    state.sidebar = Object.assign({}, state.sidebar, payload)
  },
}

export const actions = {
  toggle: ({ commit }, payload) => {
    window.localStorage.setItem('sidebar.model', payload.model)
    commit('TOGGLE', payload)
  },

  clip: ({ commit }, payload) => {
    window.localStorage.setItem('sidebar.clipped', payload.clipped)
    commit('CLIP', payload)
  },

  update: ({ commit }, payload) => {
    commit('UPDATE_SIDEBAR', payload)
  },
}

export const sidebar = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
