export const state = () => ({
  base: {
    // Toggle
    model: false
  }
})

export const getters = {
  base: state => state.base
}

export const mutations = {
  emptyState () {
    this.replaceState({
      base: {
        model: false
      }
    })
  }
}

export const base = {
  state,
  getters,
  mutations
}
