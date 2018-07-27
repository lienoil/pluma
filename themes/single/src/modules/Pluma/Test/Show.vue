<template>
  <section>
    <v-toolbar
      :class="dataset.toolbarClass"
      :flat="dataset.flat"
      :color="dataset.color"
      :dark="dataset.themeDark"
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
          v-model="dataset.searchTable"
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
        <template v-if="dataset.toggleview">
          <v-tooltip bottom>
            <v-btn
              icon
              slot="activator"
              @click="toggleView"
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
              @click="toggleView"
              >
              <v-icon>view_list</v-icon>
            </v-btn>
            <span>Switch to List View</span>
          </v-tooltip>
        </template>

        <!-- bulk -->
        <template v-if="dataset.bulkdestroy">
          <v-tooltip
            bottom
            >
            <v-btn
              @click="bulkDestroy"
              icon
              slot="activator"
              >
              <v-icon>check_circle</v-icon>
            </v-btn>
            <span>Bulk Selection</span>
          </v-tooltip>
        </template>
        <template v-else>
          <v-tooltip
            bottom
            >
            <v-btn
              @click="bulkDestroy"
              icon
              slot="activator"
              >
              <v-icon>add</v-icon>
            </v-btn>
            <span>Bulk Selection</span>
          </v-tooltip>
        </template>

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

      <!-- raised -->
      <v-btn
        color="secondary"
        v-html="trans(dataset.raisedTitle)"
        v-if="dataset.raised"
        >
      </v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12>
          <!-- <template v-if="dataset.toggleview"> -->
            <data-table :items="courses"></data-table>
          <!-- </template> -->

          <!-- <template v-else>
            <data-iterator :items="courses"></data-iterator>
          </template> -->
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

  data () {
    return {
      dataset: {
        model: '',
        title: '',
        search: '',
        toolbarClass: 'sticky v-toolbar__main',
        color: 'primary',
        flat: true,
        themeDark: true,
        spacer: true,
        sort: true,
        filter: true,
        toggleview: false,
        archive: true,
        raised: true,
        raisedButton: true,
        raisedTitle: 'Create',
        raisedColor: 'primary',
        raisedLink: '',
        searchField: false,
        searchButton: true,
        settings: true,
        dividerVertical: true,
        bulkdestroy: true,
      },

      courses: {
        bulkdestroy: true,
        selected: [],
        selectAll: false,
        searchTable: '',
        cardLink: 'tests/show',
        chip: true,
        hover: true,
        lg3: false,
        showMimetype: false,
        showToolbar: false,
        headers: [
          { text: 'ID', value: 'id' },
          { text: 'Featured', value: 'thumbnail' },
          { text: 'Title', value: 'title' },
          { text: 'Category', value: 'category' },
          { text: 'Timestamp', value: 'timestamp' },
          { text: 'Part', value: 'part' },
          { text: 'Status', value: 'status' },
          {
            text: 'Actions',
            value: 'actions',
            sortable: false,
            align: 'right',
            span: '2'
          },
        ],
        items: [
          {
            id: '1',
            title: 'Develop Personal Effectiveness at Operations Level',
            thumbnail: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
            status: 'enrolled'
          },
          {
            id: '2',
            title: 'Develop Personal Effectiveness at Supervisory Level',
            thumbnail: '//cdn.dribbble.com/users/904433/screenshots/2994633/animation_fin.gif',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
          {
            id: '3',
            title: 'Introduction to Web Programming',
            thumbnail: '//i.pinimg.com/564x/74/2b/8e/742b8e6e87ef56e698b9c8bc4e930dae.jpg',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
        ]
      },
    }
  },

  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox',
      iconmenu: 'iconmenu/iconmenu',
      dataiterator: 'dataiterator/dataiterator',
      toolbar: 'toolbar/toolbar',
      datatable: 'datatable/datatable'
    })
  },

  methods: {
    toggleView () {
      this.dataset.toggleview = !this.dataset.toggleview
    },

    bulkDestroy () {
      this.dataset.bulkdestroy = !this.dataset.bulkdestroy
    }
  }
}
</script>
