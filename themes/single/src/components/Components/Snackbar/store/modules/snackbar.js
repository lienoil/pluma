export const state = () => ({
  snackbar: {
    color: '',
    icon: 'info',
    close: true,
    type: 'success',
    timeout: 2000,
    model: false,
    title: '',
    text: 'text',
    x: 'right',
    y: 'bottom'
  }
})

export const getters = {
  snackbar: state => state.snackbar
}

export const mutations = {
  SHOW_TOAST: (state, payload) => {
    payload = Object.assign(state.snackbar, payload, { model: true })
    state.snackbar = {
      color: payload.color,
      icon: payload.icon,
      close: payload.close,
      type: payload.type,
      timeout: payload.timeout,
      model: payload.model,
      title: payload.title,
      text: payload.text,
      x: payload.x,
      y: payload.y
    }
  },
  HIDE_TOAST: (state, payload) => {
    payload = Object.assign(state.snackbar, payload, { model: false })
    state.snackbar = payload
  },
  TOGGLE_TOAST: (state, payload) => {
    payload = Object.assign(state.snackbar, payload)
    state.snackbar = payload
  }
}

export const actions = {
  showToast: (context, payload) => {
    context.commit('SHOW_TOAST', payload)
  },
  hideToast: (context, payload) => {
    context.commit('HIDE_TOAST', payload)
  }
}

export const snackbar = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
