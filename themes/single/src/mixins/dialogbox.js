export const dialogbox = {
  data () {
    return {
      dialog: {
        action: true,
        actionCallback: null,
        actionText: 'Okay',
        cancel: true,
        cancelCallback: null,
        cancelText: 'Cancel',
        model: false,
        maxWidth: '300',
        text: '',
        title: ''
      }
    }
  },
  methods: {
    dialogbox (dialog) {
      this.dialog = Object.assign(this.dialog, dialog, { model: true })
    }
  }
}
