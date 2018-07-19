export const state = () => ({
  dialogbox: {
    // Toggle
    model: false,

    // Settings
    persistent: false,

    // Buttons visibility
    action: true,
    cancel: true,
    discard: true,

    // Icon
    icon: null,

    // Icon Color
    iconColor: 'primary--text',

    // Alignment
    alignedCenter: false,

    // Buttons color
    actionColor: null,
    cancelColor: null,
    discardColor: null,

    // Buttons captions
    actionText: 'Okay',
    cancelText: 'Cancel',
    discardText: null,

    // Buttons callback
    actionCallback: null,
    discardCallback: null,
    cancelCallback () {
      this.model = false
    }
  }
})

export const getters = {
  dialogbox: state => state.dialogbox
}

export const mutations = {
  PROMPT_DIALOG (state, payload) {
    payload = Object.assign(state.dialogbox, payload)
    state.dialogbox = payload
  },

  emptyState () {
    this.replaceState({ dialogbox: null })
  }
}

export const dialogbox = {
  namespaced: true,
  state,
  getters,
  mutations
}
