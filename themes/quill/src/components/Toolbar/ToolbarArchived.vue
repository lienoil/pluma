<template>
  <v-toolbar
    class="toolbarMenu sticky px-4 emphasis--medium"
    flat
    v-model="dataset.model"
    >

    <!-- show searchField -->
    <template
      v-if="dataset.searchField"
      >
      <v-text-field
        autofocus
        append-icon="search"
        class="mr-2"
        clearable
        clear-icon="cancel"
        dark
        flat
        full-width
        hide-details
        label="Search"
        single-line
        solo
        solo-inverted
        v-model="dataset.search"
        >
      </v-text-field>
    </template>
    <!-- show searchField -->

    <!-- hide searchField -->
    <template v-else>
      <v-toolbar-title
        class="primary--text"
        >
        <strong v-html="trans(dataset.title)"></strong>
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <!-- bulk -->
      <v-tooltip bottom
        >
        <v-btn
          icon
          slot="activator"
          >
          <v-icon small>mdi-checkbox-multiple-marked-circle-outline</v-icon>
        </v-btn>
        <span>{{ trans('Bulk Selection') }}</span>
      </v-tooltip>
    </template>
    <!-- hide searchField -->

    <!-- searchButton -->
    <template
      v-if="dataset.searchField"
      >
      <v-tooltip bottom>
        <v-btn
          icon
          slot="activator"
          @click="dataset.searchField = !dataset.searchButton"
          >
          <v-icon small>close</v-icon></v-btn>
        <span>{{ trans('Close Searchbar') }}</span>
      </v-tooltip>
    </template>

    <!-- close--searchButton -->
    <template v-else>
      <v-tooltip bottom>
        <v-btn
          icon
          slot="activator"
          @click="dataset.searchField = !dataset.searchField"
          >
          <v-icon small>search</v-icon>
        </v-btn>
        <span>{{ trans('Search Resources') }}</span>
      </v-tooltip>
    </template>

    <!-- divider vertical -->
    <v-divider
      vertical
      class="mr-2"
      >
    </v-divider>

    <!-- back to home -->
    <v-tooltip
      bottom
      >
      <v-btn
        :to="dataset.homeBtn"
        icon
        slot="activator"
        >
        <v-icon small>mdi-home-outline</v-icon>
      </v-btn>
      <span>{{ trans('Go back to All Announcements') }}</span>
    </v-tooltip>
  </v-toolbar>
</template>

<script>
import store from '@/store'
import { mapGetters, mapActions } from 'vuex'

export default {
  store,
  name: 'ToolbarArchived',

  props: {
    items: {
      type: [Object, Array],
      default: () => {
        return {}
      }
    }
  },

  data () {
    return {
      dataset: {}
    }
  },

  methods: {
    ...mapActions({
      update: 'toolbar/update',
    }),

    toggleView () {
      this.update({ toggleview: !this.toolbar.toggleview })
    },
  },

  mounted () {
    this.dataset = Object.assign({}, this.toolbar, this.items)
  },

  computed: {
    ...mapGetters({
      toolbar: 'toolbar/toolbar'
    })
  }
}
</script>
