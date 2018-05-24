<template>
  <component v-bind:is="currentView"></component>
</template>

<script>

export default {
  data () {
    return {
      currentView: '',
      ajaxRoutes: this.$root.routes // loaded via ajax GET request
    }
  },
  watch: {
    '$route' (to, from) {
      if (this.ajaxRoutes[to]) {
        this.currentView = this.ajaxRoutes[to]
      }
    }
  }
}
</script>
