<template>
  <section>
    <!-- <toolbar-menu :items="dataset"></toolbar-menu> -->

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
        <template v-if="dataset.list">
          <v-tooltip bottom>
            <v-btn
              icon
              slot="activator"
              @click="toggleGrid"
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
              @click="toggleList"
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
            @click=""
            icon
            slot="activator"
            >
            <template v-if="dataset.checkbox">
              <v-icon color="success">check_circle</v-icon>
            </template>
            <template v-else>
              <v-icon>check_circle</v-icon>
            </template>
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

      <!-- create -->
      <v-btn
        color="secondary"
        v-html="trans(dataset.createTitle)"
        v-if="dataset.create"
        >
      </v-btn>
      <v-btn
        color="secondary"
        v-html="trans(dataset.uploadTitle)"
        v-if="dataset.upload"
        >
      </v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12>
          <!-- grid -->
          <template v-if="dataset.list">
            <data-table :items="courses"></data-table>
          </template>

          <!-- list -->
          <template v-else>
            <data-iterator :items="courses"></data-iterator>
          </template>

          <!-- cover image -->
          <!-- <cover-image :items="coverimage"></cover-image> -->
        </v-flex>

          <v-btn
            color="primary"
            dark
            @click.stop="dialogbox.dialog = true"
          >
            Open Dialog
          </v-btn>

          <v-dialog
            v-model="dialogbox.dialog"
            max-width=""
            flat
            >
            <div class="text-xs-center">
              <img :src="dialogbox.src" alt="">
            </div>
          </v-dialog>
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
      dialogbox: {
        dialog: false,
        src: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png'
      },
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
        grid: true,
        list: false,
        bulk: true,
        archive: true,
        create: true,
        createTitle: 'Create',
        upload: false,
        uploadTitle: 'Upload',
        searchField: false,
        searchButton: true,
        dividerVertical: true,
        emptyState: '',
        checkbox: false,
        hideCheckbox: false,
      },
      courses: {
        selected: [],
        bulkDestroy: false,
        selectAll: true,
        search: '',
        cardLink: 'tests/show',
        chip: true,
        hover: true,
        lg3: false,
        showMimetype: false,
        showToolbar: false,
        headers: [
          { text: '', value: 'selected' },
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
            align: 'center'
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
            title: 'Develop Personal Effectiveness at Supervisory Level',
            thumbnail: '//i.pinimg.com/564x/74/2b/8e/742b8e6e87ef56e698b9c8bc4e930dae.jpg',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
          {
            id: '4',
            title: 'Develop Personal Effectiveness at Supervisory Level',
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
      toolbar: 'toolbar/toolbar'
    })
  },

  methods: {
    toggleList () {
      this.dataset.list = !this.dataset.list
    },

    toggleGrid () {
      this.dataset.list = !this.dataset.grid
    },

    showCheckbox () {
      this.dataset.checkbox = !this.checkbox
    },

    toggleAll () {
      if (this.courses.selected.length) this.courses.selected = []
      else this.courses.selected = this.courses.items.slice()
    },

    changeSort (column) {
      if (this.courses.pagination.sortBy === column) {
        this.courses.pagination.descending = !this.courses.pagination.descending
      } else {
        this.courses.pagination.sortBy = column
        this.courses.pagination.descending = false
      }
    },
  }
}
</script>
