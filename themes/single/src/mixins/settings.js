import colors from 'vuetify/es5/util/colors'

export const settings = {
  data () {
    return {
      settings: {
        fontsize: this.localstorage('single.settings.fontsize', 1)
      },
      pageview: {
        current: null
      },

      /**
       *------------------------------------------
       * Theme Settings
       *------------------------------------------
       *
       */
      theme: {
        dark: this.localstorage('single.theme.dark', true) === 'true',
        light: this.localstorage('single.theme.light') === 'true'
      },

      /**
       *------------------------------------------
       * Colors
       *------------------------------------------
       *
       */
      colors: colors,

      /**
       *------------------------------------------
       * Sidebar Settings
       *------------------------------------------
       *
       */
      sidebar: {
        dark: this.localstorage('single.sidebar.dark', true) === 'true' || true,
        clipped: this.localstorage('single.sidebar.clipped', false) === 'true',
        floating: this.localstorage('single.sidebar.floating', false) === 'true',
        mini: this.localstorage('single.sidebar.mini', false) === 'true',
        model: false,
        withBackground: this.localstorage('single.sidebar.withBackground') === 'true',
        style: {
          background: this.localstorage('single.sidebar.style.background') || 'none',
          color: this.localstorage('single.sidebar.style.color') || this.$root.$vuetify.theme.secondary,
          rgba: {
            r: 0,
            g: 0,
            b: 0,
            a: 50
          }
        }
      },

      /**
       *------------------------------------------
       * Snackbar Settings
       *------------------------------------------
       *
       */
      snackbar: {
        color: 'secondary',
        icon: 'info',
        close: true,
        type: 'success',
        timeout: 10000,
        model: false,
        title: '',
        text: '',
        x: 'right',
        y: 'bottom'
      },

      /**
       *------------------------------------------
       * Dialog Settings
       *------------------------------------------
       *
       */
      dialog: {
        color: 'secondary',
        icon: 'info',
        type: 'success',
        timeout: 10000,
        model: false,
        title: '',
        text: '',
        x: 'right',
        y: 'top'
      },

      /**
       *------------------------------------------
       * Rightsidebar Settings
       *------------------------------------------
       *
       */
      rightsidebar: {
        clipped: this.localstorage('single.rightsidebar.clipped') === 'true',
        floating: this.localstorage('single.rightsidebar.floating') === 'true',
        mini: this.localstorage('single.rightsidebar.mini') === 'true',
        model: false,
        tabs: {
          model: 0
        }
      },

      /**
       *-------------------------------------------
       * Utilitybar
       *-------------------------------------------
       *
       */
      utilitybar: {
        dark: this.localstorage('single.utilitybar.dark', true) === 'true' || true,
        model: false
      },

      /**
       *------------------------------------------
       * Flash Session
       *------------------------------------------
       *
       * FLASH! Ah-haaaaaaaaa
       * Saviour of the universe!
       * FLASH! Ah-haaaaaaaaa
       * He'll save everyone of us!
       *
       */
      flash: {
        model: false
      },

      /**
       *------------------------------------------
       * Dialog Settings
       *------------------------------------------
       *
       */
      bottomsheet: {
        color: 'secondary',
        icon: 'info',
        type: 'success',
        inset: true,
        timeout: 10000,
        model: false,
        title: '',
        text: '',
        x: 'right',
        y: 'top'
      }
    }
  },
  methods: {
    search () {
      return {
        open (event) {
          let input = event.target.querySelector('input')
          document.getElementById('searchbar').scrollIntoView()
          input.focus()
        }
      }
    },
    alert (snackbar, fetchFromServer) {
      // Get sessions every page transition
      if (fetchFromServer) {
        this.$http.post('/admin/sessions')
          .then(response => {
            if (typeof response.data.message !== 'undefined') {
              this.snackbar = Object.assign(this.snackbar, {
                model: true,
                color: response.data.type ? response.data.type : 'secondary',
                icon: response.data.icon ? response.data.icon : 'info',
                timeout: response.data.timeout ? response.data.timeout : 10000,
                text: response.data.message,
                title: response.data.title ? response.data.title : ''
              }, snackbar)
            }
          })
      } else {
        this.snackbar = Object.assign(this.snackbar, snackbar, { model: true })
      }
    }
  }
}
