<template>
  <v-toolbar
    class="toolbarMenu sticky px-4"
    color="primary"
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
        class="white--text subheading"
        v-html="trans(dataset.title)"
        >
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <!-- bulk -->
      <v-tooltip bottom
        >
        <v-btn
          icon
          dark
          slot="activator"
          >
          <v-icon small>mdi-checkbox-multiple-marked-circle-outline</v-icon>
        </v-btn>
        <span>{{ trans('Bulk Selection') }}</span>
      </v-tooltip>

      <!-- sort -->
      <v-tooltip
        bottom
        >
        <v-btn
          icon
          dark
          slot="activator"
          >
          <v-icon small v-html="dataset.sort ? 'mdi-sort-ascending' : 'mdi-sort-descending'"></v-icon>
        </v-btn>
        <span>{{ trans('Sort') }}</span>
      </v-tooltip>

      <!-- filter -->
      <v-tooltip
        bottom
        >
        <v-btn
          icon
          dark
          slot="activator"
          >
          <v-icon small>mdi-filter-outline</v-icon>
        </v-btn>
        <span>Filter</span>
      </v-tooltip>

      <!-- list and grid view -->
      <template v-if="dataset.listGridView">
        <!-- grid -->
        <template v-if="toolbar.toggleview">
          <v-tooltip
            bottom
            >
            <v-btn
              @click="toggleView"
              icon
              dark
              slot="activator"
              >
              <v-icon small>mdi-grid-large</v-icon>
            </v-btn>
            <span>{{ trans('Switch to Grid View') }}</span>
          </v-tooltip>
        </template>
        <!-- list -->
        <template v-else>
          <v-tooltip
            bottom
            >
            <v-btn
              icon
              dark
              slot="activator"
              @click="toggleView"
              >
              <v-icon small>mdi-format-list-checkbox</v-icon>
            </v-btn>
            <span>{{ trans('Switch to List View') }}</span>
          </v-tooltip>
        </template>
      </template>

      <!-- archive -->
      <v-tooltip
        bottom
        >
        <v-btn
          :to="dataset.archivedBtn"
          icon
          dark
          slot="activator"
          >
          <v-icon small>mdi-package-variant</v-icon>
        </v-btn>
        <span>{{ trans('Archived List') }}</span>
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
          dark
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
          dark
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

    <!-- create -->
    <v-btn
      :to="dataset.createBtn"
      color="secondary"
      dark
      depressed
      >
      {{ __('Create') }}
    </v-btn>
  </v-toolbar>
</template>

<script>
import store from '@/store'
import { mapGetters, mapActions } from 'vuex'

export default {
  store,
  name: 'ToolbarMenu',

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
