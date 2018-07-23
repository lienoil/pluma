<template>
  <section>

    <v-toolbar
      dark
      flat
      class="primary sticky v-toolbar__main"
      >
      <!-- <v-menu left>
        <v-btn
          flat
          large
          class="primary--text"
          slot="activator"
          >
          Library <v-icon right>keyboard_arrow_down</v-icon>
        </v-btn>

        <v-list>
          <v-list-tile ripple @click="">
            <v-list-tile-action>
              <v-icon>create_new_folder</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>New Folder</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile ripple @click="">
            <v-list-tile-action>
              <v-icon>cloud_upload</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Upload Files</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-menu> -->
      <v-toolbar-title>All Courses</v-toolbar-title>
      <v-spacer></v-spacer>
      <template v-model="showListView" v-if="showListView">
        <v-tooltip bottom>
          <v-btn icon slot="activator" @click="showListView = !showGridView"><v-icon>view_module</v-icon></v-btn>
          <span>Switch to Grid View</span>
        </v-tooltip>
      </template>
      <template v-else>
        <v-tooltip bottom>
          <v-btn icon slot="activator" @click="showListView = !showListView"><v-icon>view_list</v-icon></v-btn>
          <span>Switch to List View</span>
        </v-tooltip>
      </template>

      <v-tooltip bottom>
        <v-btn icon slot="activator">
          <v-icon>check_circle</v-icon>
        </v-btn>
        <span>Toggle Bulk Command</span>
      </v-tooltip>
      <v-tooltip bottom>
        <v-btn icon slot="activator">
          <v-icon>archive</v-icon>
        </v-btn>
        <span>View Trashed Items</span>
      </v-tooltip>
      <v-divider
        vertical
        class="mx-2">
      </v-divider>
      <v-btn class="secondary">Create</v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
     <!--  <v-layout row wrap>
        <v-flex md4 xs12>
          <v-card flat class="mb-3 text-xs-center">
            <v-card-title class="emphasis--medium">Dialogbox</v-card-title>
            <v-card-text>
              <dialogbox></dialogbox>
              <v-btn color="secondary" @click="openDialogbox">Open Dialog Test</v-btn>
            </v-card-text>
          </v-card>

          <v-card class="mb-3">
            <v-card-title class="emphasis--medium">IconMenu</v-card-title>
            <v-card-text>
              <icon-menu></icon-menu>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout> -->

      <v-layout row wrap>
        <v-flex xs12>
          <!-- grid / list view -->
          <template v-model="showListView" v-if="showListView">
            <data-table :items="courses"></data-table>
          </template>

          <template v-else>
            <data-iterator search :items="courses"></data-iterator>
          </template>
          <!-- grid / list view -->

          <!-- <data-table :items="courses"></data-table> -->
        </v-flex>
      </v-layout>
    </v-container>
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

  data () {
    return {
      showListView: false,
      showGridView: true,
      iconmenu: {
        multiple: true
      },
      courses: {
        cardLink: '//www.google.com',
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
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/2.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
          {
            id: '2',
            title: 'Develop Personal Effectiveness at Supervisory Level',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/6.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
          {
            id: '3',
            title: 'Develop Personal Effectiveness at Supervisory Level',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/1.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
        ]
      },
      library: {
        cardMediaHeight: '120px',
        lg2: true,
        lg3: false,
        md2: true,
        md4: false,
        showCardText: false,
        showPart: false,
        xs12: false,
        items: [
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/6.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/1.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/2.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/3.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/4.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/5.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          }
        ]
      },
    }
  },

  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox',
      iconmenu: 'iconmenu/iconmenu',
      dataiterator: 'dataiterator/dataiterator'
    })
  },

  methods: {
    openDialogbox () {
      this.$store.dispatch(
        'dialogbox/PROMPT_DIALOG',
        Object.assign(
          this.dialogbox,
          {
            model: true,
            // icon: 'add',
            // iconColor: 'success--text',
            image: '//img.stackshare.io/stack/26394/laravel_logo-circle-tp-xs.png',
            title: 'Delete Resources',
            text: 'You are about to permanently delete those resources.This action is irreversible. Do you want to proceed?',
            persistent: true,
            width: '100%',
            alignedCenter: true,

            actionText: 'Delete',
            actionColor: 'error',
            actionCallback () {
              this.model = false
              // store.dispatch.saveUserOrSomeShitLikeThat
              // then...
            },

            discard: false,
          }
        )
      )
    },

    toggleAll () {
      if (this.selected.length) this.selected = []
      else this.selected = this.desserts.slice()
    },
    changeSort (column) {
      if (this.pagination.sortBy === column) {
        this.pagination.descending = !this.pagination.descending
      } else {
        this.pagination.sortBy = column
        this.pagination.descending = false
      }
    }
  }
}
</script>
