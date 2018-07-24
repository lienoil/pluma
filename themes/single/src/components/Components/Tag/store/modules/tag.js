export const state = () => ({
  tag: {
    clearable: true,
    hint: 'To add new tags, type the word on field and press enter.',
    label: 'Choose Tag/s',
    multiple: true,
    persistentHint: true,
    search: null,
    items: [],
  }
})

export const getters = {
  tag: state => state.tag
}

export const mutations = {
  emptyState () {
    this.replaceState({ tag: null })
  }
}

export const tag = {
  namespaced: true,
  state,
  getters,
  mutations
}
