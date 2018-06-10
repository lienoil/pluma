export const bottomsheetbox = {
  data () {
    return {
      bottomsheet: {
        cancelCallback: () => {
          this.model = false
        },
        cancelText: 'Cancel',
        color: 'white',
        discardCallback: () => {
          this.model = false
        },
        discardText: 'Discard Changes',
        fullWidth: false,
        inset: true,
        model: false,
        persistent: false,
        saveAsDraftCallback: () => {
          this.model = false
        },
        saveAsDraftText: 'Save as Draft',
        text: '',
        title: ''
      }
    }
  },
  methods: {
    bottomsheetbox (bottomsheet) {
      this.bottomsheet = Object.assign(this.bottomsheet, bottomsheet, { model: true })
    }
  }
}
