export const state = () => ({
  contextmenu: {
    show: false,
    x: 0,
    y: 0,
    menus: [],
  }
})

export const getters = {
  contextmenu: state => state.contextmenu
}

export const mutations = {
  'OPEN' (state, payload) {
    state.contextmenu.show = true
    state.contextmenu.x = payload.x
    state.contextmenu.y = payload.y
    state.contextmenu.menus.push(payload)
  },

  'CLOSE' (state) {
    state.contextmenu.show = false
    state.contextmenu.menus.forEach((menu) => {
      menu.show = false
    })
  }
}

export const actions = {
  open: ({commit}, payload) => {
    commit('OPEN', payload)
  },

  close: ({commit}) => {
    commit('CLOSE')
  }
}

export const contextmenu = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
