import _get from 'lodash/get'

export const trans = {
  methods: {
    trans: (string, defaultString) => {
      return _get(window.i18n.phrases, string, defaultString || string)
    }
  }
}
