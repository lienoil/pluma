export const state = () => ({
  timeline: {
    model: true,
    monthYear: 'August 2018',
    dateToday: 'August 01, 2018',
    items: [
      {
        user: 'John Doe',
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
