<template>
  <v-toolbar
    :class="dataset.toolbarClass"
    :flat="dataset.flat"
    :color="dataset.color"
    :dark="dataset.themeDark"
    v-model="dataset.model"
    >

    <!-- show searchField -->
    <template
      v-model="dataset.searchField"
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
        v-html="trans(dataset.title)"
        >
      </v-toolbar-title>
      <v-spacer v-if="dataset.spacer"></v-spacer>

      <!-- sort -->
      <v-tooltip
        bottom
        v-if="dataset.sort"
        >
        <v-btn
          @click="dataset.sortLink"
          icon
          slot="activator"
          >
          <v-icon>fa fa-sort</v-icon>
        </v-btn>
        <span>Sort</span>
      </v-tooltip>

      <!-- filter -->
      <v-tooltip
        bottom
        v-if="dataset.filter"
        >
        <v-btn
          @click="dataset.filterLink"
          icon
          slot="activator"
          >
          <v-icon>fa fa-filter</v-icon>
        </v-btn>
        <span>Filter</span>
      </v-tooltip>

      <!-- grid -->
      <template v-model="dataset.list" v-if="dataset.list">
        <v-tooltip bottom>
          <v-btn
            icon
            slot="activator"
            @click="dataset.list = !dataset.grid"
            >
            <v-icon>view_module</v-icon>
          </v-btn>
          <span>Switch to Grid View</span>
        </v-tooltip>
      </template>

      <!-- list -->
      <template v-else>
        <v-tooltip bottom>
          <v-btn
            icon
            slot="activator"
            @click="dataset.list = !dataset.list"
            >
            <v-icon>view_list</v-icon>
          </v-btn>
          <span>Switch to List View</span>
        </v-tooltip>
      </template>

      <!-- bulk -->
      <v-tooltip
        bottom
        v-if="dataset.bulk"
        >
        <v-btn
          @click="dataset.bulkLink"
          icon
          slot="activator"
          >
          <v-icon>check_circle</v-icon>
        </v-btn>
        <span>Bulk Selection</span>
      </v-tooltip>

      <!-- archive -->
      <v-tooltip
        bottom
        v-if="dataset.archive"
        >
        <v-btn
          @click="dataset.archiveLink"
          icon
          slot="activator"
          >
          <v-icon>archive</v-icon>
        </v-btn>
        <span>Trashed List</span>
      </v-tooltip>
    </template>
    <!-- hide searchField -->

    <!-- searchButton -->
    <template
      v-model="dataset.searchField"
      v-if="dataset.searchField"
      >
      <v-tooltip bottom>
        <v-btn
          icon
          slot="activator"
          @click="dataset.searchField = !dataset.searchButton"
          >
          <v-icon>close</v-icon></v-btn>
        <span>Close Searchbar</span>
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
          <v-icon>search</v-icon>
        </v-btn>
        <span>Search Resources</span>
      </v-tooltip>
    </template>

    <!-- divider vertical -->
    <v-divider
      vertical
      v-if="dataset.dividerVertical"
      class="mr-2"
      color="white"
      >
    </v-divider>

    <!-- raised button -->
    <v-btn
      :color="dataset.raisedColor"
      v-html="trans(dataset.raisedTitle)"
      v-if="dataset.raisedButton"
      :href="dataset.raisedLink"
      >
    </v-btn>
  </v-toolbar>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

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
