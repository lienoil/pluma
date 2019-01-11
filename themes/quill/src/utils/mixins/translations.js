import _get from 'lodash/get'

export default {
  name: 'trans',
  methods: {
    trans: function (string, defaultString) {
      let phrases = (window.i18n && window.i18n.phrases) || string

      return _get(phrases, string, defaultString || string)
    },

    __: function (string, defaultString) {
      return this.trans(string, defaultString)
    },
  }
}
