export const state = () => ({
  timeline: {
    model: true,
    items: [
      {
        user: 'Princess Alto'
      }
    ]
  },
})

export const getters = {
  timeline: state => state.timeline
}

export const mutations = {
  emptyState () {
    this.replaceState({ timeline: null })
  }
}

export const timeline = {
  namespaced: true,
  state,
  getters,
  mutations
}
