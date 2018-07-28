export const state = () => ({
  gallery: {
    imageClass: 'img-responsive',
    items: []
  },
})

export const getters = {
  gallery: state => state.gallery
}

export const mutations = {
  emptyState () {
    this.replaceState({ gallery: null })
  }
}

export const gallery = {
  namespaced: true,
  state,
  getters,
  mutations
}
