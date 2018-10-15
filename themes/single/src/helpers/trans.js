import _get from 'lodash/get'

export default {
  name: 'trans',
  methods: {
    trans: (string, defaultString) => {
      return _get(window.i18n.phrases, string, defaultString || string)
    }
  }
}
