<template v-cloak>
  <section>
    <template v-if="courses.loaded">
      <v-card
        flat
        class="transparent text-xs-center"
        height="70vh"
        >
        <v-layout fill-height column justify-center align-center>
          <add-user-icon width="120" height="120"></add-user-icon>
          <v-card-text class="grey--text">
            <h3>You do not have any resources on this module.</h3>
            <p>Start upload by clicking the button below.</p>
            <v-btn color="secondary">
              {{ trans('Create Test') }}
            </v-btn>
          </v-card-text>
        </v-layout>
      </v-card>
    </template>


    <template v-else>
      <toolbar-menu :items="toolbar"></toolbar-menu>

      <v-container fluid grid-list-lg>
        <v-layout row wrap>
          <v-flex xs12>
            <!-- grid / list view -->
            <template v-if="toolbar.toggleview">
              <data-table :items="courses"></data-table>
            </template>

            <template v-else>
              <data-iterator :items="courses"></data-iterator>
            </template>
            <!-- grid / list view -->
          </v-flex>
        </v-layout>
      </v-container>
    </template>
  </section>
</template>

<style>
  .v-input__slot {
    margin-bottom: 0;
  }
</style>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

  components: {},

  data () {
    return {
      toolbar: {
        title: 'All Courses'
      },
      courses: {
        loaded: false,
        selected: [],
        bulkDestroy: false,
        selectAll: true,
        search: '',
        cardLink: 'courses/show',
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
            align: 'center'
          },
        ],
        items: [
          {
            id: '1',
            title: 'Develop Personal Effectiveness at Operations Level',
            thumbnail: '//preview.ibb.co/cMCYYz/card_Media.png',
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
            thumbnail: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
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
      dataiterator: 'dataiterator/dataiterator',
      toolbar: 'toolbar/toolbar',
      datatable: 'datatable/datatable',
    })
  },

  methods: {
    changeSort (column) {
      if (this.courses.pagination.sortBy === column) {
        this.courses.pagination.descending = !this.courses.pagination.descending
      } else {
        this.courses.pagination.sortBy = column
        this.courses.pagination.descending = false
      }
    },

    save () {
      this.category.isEditing = !this.category.isEditing
      this.category.hasSaved = true
    }
  }
}
</script>
