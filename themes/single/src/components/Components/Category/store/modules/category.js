export const state = () => ({
  category: {
    categoryList: false,
    categoryCreate: true,
    label: 'Choose Category',
    items: [],
    chipColor: 'secondary',
    iconColor: 'white--text',
  }
})

export const getters = {
  category: state => state.category
}

export const mutations = {
  emptyState () {
    this.replaceState({ category: null })
  }
}

export const category = {
  namespaced: true,
  state,
  getters,
  mutations
}
