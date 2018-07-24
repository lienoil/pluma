<template>
  <v-breadcrumbs class="px-4 py-1">
    <v-icon slot="divider">keyboard_arrow_right</v-icon>
    <v-breadcrumbs-item
      :key="i"
      :to="breadcrumb.path"
      exact
      ripple
      v-for="(breadcrumb, i) in $route.matched"
    >
      <small v-html="trans(breadcrumb.meta.title)"></small>
    </v-breadcrumbs-item>
  </v-breadcrumbs>
</template>

<script>
import store from './store'
import { mapGetters, mapActions } from 'vuex'

export default {
  store,

  name: 'Breadcrumbs',

  computed: {
    ...mapGetters({
      breadcrumbs: 'breadcrumbs/breadcrumbs'
    })
  },

  methods: {
    ...mapActions({
      set: 'breadcrumbs/set'
    })
  },
}
</script>
