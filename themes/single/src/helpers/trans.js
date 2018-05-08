import _ from 'lodash'

export const trans = {
  methods: {
    trans: (string, defaultString) => {
      return _.get(window.i18n.phrases, string, defaultString || string)
    }
  }
}
