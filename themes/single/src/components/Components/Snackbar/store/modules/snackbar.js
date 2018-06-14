export const state = () => ({
  snackbar: {
    // Toggle
    model: false,

    // Typography
    text: 'text',
    icon: 'info',

    // Settings
    color: '',
    timeout: 4000,
    mode: null, // e.g. multi-line, vertical

    // Position
    x: 'right',
    y: 'bottom',

    // Button
    button: true,
    buttonIcon: false,
    buttonText: 'Okay',
    buttonCallback: () => {}
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
  },

  emptyState () {
    this.replaceState({ snackbar: null })
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
