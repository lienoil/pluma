export const settings = {
  data () {
    return {
      settings: {
        fontsize: this.localstorage('single.settings.fontsize') ? this.localstorage('single.settings.fontsize') : 1
      },
      view: {
        current: 'PageIndex'
      },

      /**
       *------------------------------------------
       * Theme Settings
       *------------------------------------------
       *
       */
      theme: {
        dark: this.localstorage('single.theme.dark') === 'true',
        light: this.localstorage('single.theme.light') === 'true'
      },

      /**
       *------------------------------------------
       * Sidebar Settings
       *------------------------------------------
       *
       */
      sidebar: {
        clipped: this.localstorage('single.sidebar.clipped') === 'true',
        floating: this.localstorage('single.sidebar.floating') === 'true',
        mini: this.localstorage('single.sidebar.mini') === 'true',
        model: true
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
      }
    }
  },
  methods: {
    localstorage (key, value) {
      if (typeof value === 'undefined') {
        // get localstorage
        return window.localStorage.getItem(key)
      } else {
        window.localStorage.setItem(key, value)
        return true
      }
    }
  }
}
