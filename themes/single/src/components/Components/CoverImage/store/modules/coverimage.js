export const state = () => ({
  coverimage: {
    // Card
    cardClass: '',
    model: '',
    cardHeight: '160px',
    cardColor: 'primary',
    cardHover: true,
    cardLink: '',

    // Card Media
    thumbnail: '',
    cardMediaHeight: '',
    cardMediaClass: '',
  },
})

export const getters = {
  coverimage: state => state.coverimage
}

export const mutations = {
  emptyState () {
    this.replaceState({ coverimage: null })
  }
}

export const coverimage = {
  namespaced: true,
  state,
  getters,
  mutations
}
