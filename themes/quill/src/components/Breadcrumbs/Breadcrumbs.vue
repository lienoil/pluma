<template>
  <div>
    <v-breadcrumbs
      v-if="breadcrumbs.model"
      class="px-4 py-2"
      >
      <v-breadcrumbs-item
        :key="i"
        :to="item.path"
        exact
        ripple
        v-for="(item, i) in $route.matched"
      >
        <small v-html="trans(item.meta.title)"></small>
      </v-breadcrumbs-item>
    </v-breadcrumbs>
  </div>
</template>

<script>
import store from '@/store'
import { mapGetters, mapActions } from 'vuex'

export default {
  store,

  name: 'Breadcrumbs',

  computed: {
    ...mapGetters({
      breadcrumbs: 'breadcrumbs/breadcrumbs',
      sidebar: 'sidebar/sidebar',
    })
  },

  methods: {
    ...mapActions({
      set: 'breadcrumbs/set'
    })
  },
}
</script>
